<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\ActionData\Country\CountryActionData;
use App\Filters\Country\CountryFilter;
use App\Http\Controllers\Controller;
use App\Services\Admin\CountryService;
use App\ViewModels\Country\CountryViewModel;
use App\ViewModels\PaginationViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CountryController extends Controller
{
    public function __construct(protected CountryService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */

    public function index(Request $request): View
    {
        $filters[] = CountryFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'),limit: (int)$request->get('limit', 10),  filters: $filters);
        return (new PaginationViewModel($collection, CountryViewModel::class))
            ->toView('admin.countries.index');
    }

    /**
     * @return View
     */

    public function create(): View
    {
        $viewModel = CountryViewModel::createEmpty();
        return $viewModel->toView('admin.countries.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(CountryActionData $actionData): RedirectResponse
    {
        $this->service->store($actionData);
        return redirect()->route("countries.index")->with('res', [
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
        $viewModel = new CountryViewModel($data);
        return $viewModel->toView('admin.countries.edit');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $actionData = CountryActionData::fromRequest($request);
        $this->service->update($actionData, $id);
        return redirect()->route("countries.index")->with('res', [
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
        return redirect()->route("countries.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }
}
