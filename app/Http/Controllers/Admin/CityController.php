<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\City\CityActionData;
use App\Filters\City\CityFilter;
use App\Http\Controllers\Controller;
use App\Services\Admin\CityService;
use App\Services\Admin\CountryService;
use App\ViewModels\City\CityViewModel;
use App\ViewModels\Country\CountryViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(
        protected CityService    $service,
        protected CountryService $countryService
    )
    {
    }

    /**
     * @param Request $request
     * @return View
     */

    public function index(Request $request): View
    {
        $filters[] = CityFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);

        $countries = $this->countryService->getAll();
        $countries->transform(fn($country) => CountryViewModel::fromDataObject($country));

        return (new PaginationViewModel($collection, CityViewModel::class))
            ->toView('admin.cities.index', compact('countries'));
    }

    /**
     * @return View
     */

    public function create(): View
    {
        $viewModel = CityViewModel::createEmpty();

        $countries = $this->countryService->getAll();
        $countries->transform(fn($country) => CountryViewModel::fromDataObject($country));

        return $viewModel->toView('admin.cities.create', compact('countries'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CityActionData $actionData): RedirectResponse
    {
        $this->service->store($actionData);
        return redirect()->route("cities.index")->with('res', [
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
        $viewModel = new CityViewModel($data);

        $countries = $this->countryService->getAll();
        $countries->transform(fn($country) => CountryViewModel::fromDataObject($country));

        return $viewModel->toView('admin.cities.edit', compact('countries'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(CityActionData $actionData, int $id): RedirectResponse
    {
        $this->service->update($actionData, $id);
        return redirect()->route("cities.index")->with('res', [
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
        return redirect()->route("cities.index")->with('res', [
            "method" => "success",
            "msg" => trans('table.success_message'),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCitiesByCountryId(Request $request): JsonResponse
    {
        $filters[] = CityFilter::getRequest($request);
        $cities = $this->service->getCitiesByCountryId($filters);
        $cities->transform(fn($city) => CityViewModel::fromDataObject($city));
        return response()->json([
           'status' => true,
           'data' => $cities->toArray(),
        ]);
    }
}
