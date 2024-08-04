<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\ActionData\Direction\DirectionActionData;
use App\Filters\Direction\DirectionFilter;
use App\Http\Controllers\Controller;
use App\Services\Admin\DirectionService;
use App\Services\Admin\UniversityService;
use App\ViewModels\Direction\DirectionViewModel;
use App\ViewModels\PaginationViewModel;
use App\ViewModels\University\UniversityViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    public function __construct(
        protected DirectionService $service,
        protected UniversityService $universityService
    )
    {
    }

    /**
     * @param Request $request
     * @return View
     */

    public function index(Request $request): View
    {
        $filters[] = DirectionFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('page', 10), filters: $filters);
        return (new PaginationViewModel($collection, DirectionViewModel::class))
            ->toView('admin.directions.index');
    }

    /**
     * @return View
     */

    public function create(): View
    {
        $viewModel = DirectionViewModel::createEmpty();
        $universities = $this->universityService->getAllUniversities();
        $universities->transform(fn($data) => UniversityViewModel::fromDataObject($data));
        return $viewModel->toView('admin.directions.create', compact('universities'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $actionData = DirectionActionData::fromRequest($request);
        $this->service->store($actionData);
        return redirect()->route("direction.index")->with('res', [
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
        $viewModel = new DirectionViewModel($data);
        $universities = $this->universityService->getAllUniversities();
        $universities->transform(fn($data) => UniversityViewModel::fromDataObject($data));
        return $viewModel->toView('admin.directions.edit', compact('universities'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $actionData = DirectionActionData::fromRequest($request);
        $this->service->update($actionData, $id);
        return redirect()->route("direction.index")->with('res', [
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
        return redirect()->route("direction.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }
}
