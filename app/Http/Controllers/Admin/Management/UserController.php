<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin\Management;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Management\User\StoreUserActionData;
use App\ActionData\Management\User\UpdateUserActionData;
use App\Filters\Management\User\UserFilter;
use App\Http\Controllers\Controller;
use App\Services\Admin\Management\RoleService;
use App\Services\Admin\Management\UserService;
use App\ViewModels\Management\User\UserViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */

    public function index(Request $request): View
    {
        $filters[] = UserFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'),limit: (int)$request->get('limit', 10), filters: $filters);
        $roles = (new RoleService())->getAllRoles();
        return (new PaginationViewModel($collection, UserViewModel::class))
            ->toView('admin.management.users.index', compact('roles'));
    }

    /**
     * @return View
     */

    public function create(): View
    {
        $roles = (new RoleService())->getAllRoles();
        $viewModel = UserViewModel::createEmpty();
        return $viewModel->toView('admin.management.users.create', compact('roles'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreUserActionData $actionData): RedirectResponse
    {
        $this->service->store($actionData);
        return redirect()->route("users.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }

    /**
     * @param int $id
     * @return View
     * @throws \Exception
     */
    public function edit(int $id): View
    {
        $data = $this->service->edit($id);
        $viewModel = new UserViewModel($data);
        $roles = (new RoleService())->getAllRoles();
        return $viewModel->toView('admin.management.users.edit', compact('roles'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateUserActionData $actionData, int $id): RedirectResponse
    {
        $this->service->update($actionData, $id);
        return redirect()->route("users.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->delete($id);
        return redirect()->route("users.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }
}
