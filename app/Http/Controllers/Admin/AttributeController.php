<?php

namespace App\Http\Controllers\Admin;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Attribute\AttributeActionData;
use App\ActionData\Attribute\UpdateAttributeActionData;
use App\Filters\Attribute\AttributeFilter;
use App\Http\Controllers\Controller;
use App\Services\Admin\AttributeService;
use App\ViewModels\Attribute\AttributeViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function __construct(protected AttributeService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */

    public function index(Request $request): View
    {
        $filters[] = AttributeFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'),limit:(int)$request->get('limit', 10), filters: $filters);

        return (new PaginationViewModel($collection, AttributeViewModel::class))
            ->toView('admin.attributes.index');
    }

    /**
     * @return View
     */

    public function create(): View
    {
        $viewModel = AttributeViewModel::createEmpty();
        return $viewModel->toView('admin.attributes.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(AttributeActionData $actionData):RedirectResponse
    {
        $this->service->store($actionData);
        return redirect()->route("attributes.index")->with('res', [
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
        $viewModel = new AttributeViewModel($data);
        return $viewModel->toView('admin.attributes.edit');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateAttributeActionData $actionData, int $id):RedirectResponse
    {
        $this->service->update($actionData, $id);
        return redirect()->route("attributes.index")->with('res', [
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
        return redirect()->route("attributes.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }
}
