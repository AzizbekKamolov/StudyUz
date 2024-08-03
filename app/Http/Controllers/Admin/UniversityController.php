<?php

namespace App\Http\Controllers\Admin;

use App\ActionData\University\UniversityActionData;
use App\Filters\University\UniversityFilter;
use App\Http\Controllers\Controller;
use App\Services\Admin\UniversityService;
use App\ViewModels\University\UniversityViewModel;
use App\ViewModels\PaginationViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UniversityController extends Controller
{

    public function __construct(protected UniversityService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */

    public function index(Request $request): View
    {
        $filters[] = UniversityFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return (new PaginationViewModel($collection, UniversityViewModel::class))
            ->toView('admin.universities.index');
    }

    /**
     * @return View
     */

    public function create(): View
    {
        $viewModel = UniversityViewModel::createEmpty();
        return $viewModel->toView('admin.universities.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request):RedirectResponse
    {
        $actionData = StoreUniversityActionData::fromRequest($request);
        $this->service->store($actionData);
        return redirect()->route("universities.index")->with('res', [
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
        $viewModel = new UniversityViewModel($data);
        return $viewModel->toView('admin.universities.edit');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id):RedirectResponse
    {
        $actionData = UniversityActionData::fromRequest($request);
        $this->service->update($actionData, $id);
        return redirect()->route("universities.index")->with('res', [
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
        return redirect()->route("universities.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }
}
