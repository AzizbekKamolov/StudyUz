<?php

namespace App\Http\Controllers\Admin\Management;

use App\ActionData\Management\Role\StoreRoleActionData;
use App\ActionData\Management\Role\UpdateRoleActionData;
use App\Filters\Management\Role\RoleFilter;
use App\Http\Controllers\Controller;
use App\Services\Admin\Management\PermissionService;
use App\Services\Admin\Management\RoleService;
use App\ViewModels\Management\Role\RoleViewModel;
use App\ViewModels\PaginationViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(protected RoleService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */

    public function index(Request $request): View
    {
        $filters[] = RoleFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'),limit: (int)$request->get('page', 10), filters: $filters);
        return (new PaginationViewModel($collection, RoleViewModel::class))
            ->toView('admin.management.roles.index');
    }

    /**
     * @return View
     */

    public function create(): View
    {
        $viewModel = RoleViewModel::createEmpty();
        $permissions = (new PermissionService())->getAllPermissions();
        return $viewModel->toView('admin.management.roles.create', compact('permissions'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $actionData = StoreRoleActionData::fromRequest($request);
        $this->service->store($actionData);
        return redirect()->route("roles.index")->with('res', [
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
        $viewModel = new RoleViewModel($data);
        $permissions = (new PermissionService())->getAllPermissions();
        return $viewModel->toView('admin.management.roles.edit', compact('permissions'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $actionData = UpdateRoleActionData::fromRequest($request);
        $this->service->update($actionData, $id);
        return redirect()->route("roles.index")->with('res', [
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
        return redirect()->route("roles.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }
}
