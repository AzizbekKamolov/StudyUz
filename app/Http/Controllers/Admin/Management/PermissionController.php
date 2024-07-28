<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin\Management;

use App\ActionData\Management\Permission\StorePermissionActionData;
use App\ActionData\Management\Permission\UpdatePermissionActionData;
use App\Filters\Management\Permission\PermissionFilter;
use App\Http\Controllers\Controller;
use App\Services\Admin\Management\PermissionService;
use App\ViewModels\Management\Permission\PermissionViewModel;
use App\ViewModels\PaginationViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(protected PermissionService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */

    public function index(Request $request): View
    {
        $filters[] = PermissionFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return (new PaginationViewModel($collection, PermissionViewModel::class))
            ->toView('admin.management.permissions.index');
    }

    /**
     * @return View
     */

    public function create(): View
    {
        $viewModel = PermissionViewModel::createEmpty();
        return $viewModel->toView('admin.management.permissions.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request):RedirectResponse
    {
        $actionData = StorePermissionActionData::fromRequest($request);
        $this->service->store($actionData);
        return redirect()->route("permissions.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }

    /**
     * @param int $id
     * @return View
     * @throws \Exception
     */
    public function edit(int $id):View
    {
        $data = $this->service->edit($id);
        $viewModel = new PermissionViewModel($data);
        return $viewModel->toView('admin.management.permissions.edit');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id):RedirectResponse
    {
        $actionData = UpdatePermissionActionData::fromRequest($request);
        $this->service->update($actionData, $id);
        return redirect()->route("permissions.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function delete(int $id):RedirectResponse
    {
        $this->service->delete($id);
        return redirect()->route("permissions.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }
}
