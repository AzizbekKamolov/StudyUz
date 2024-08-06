<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\University\UniversityActionData;
use App\Filters\City\CityFilter;
use App\Filters\University\UniversityFilter;
use App\Http\Controllers\Controller;
use App\Services\Admin\CityService;
use App\Services\Admin\CountryService;
use App\Services\Admin\UniversityService;
use App\ViewModels\City\CityViewModel;
use App\ViewModels\Country\CountryViewModel;
use App\ViewModels\University\UniversityViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UniversityController extends Controller
{

    public function __construct(
        protected UniversityService $service,
        protected CountryService $countryService,
    )
    {
    }

    /**
     * @param Request $request
     * @return View
     */

    public function index(Request $request): View
    {
        $filters[] = UniversityFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), limit:(int)$request->get('limit', 10),  filters: $filters);

        $countries = $this->countryService->getAll();
        $countries->transform(fn($country) => CountryViewModel::fromDataObject($country));
        return (new PaginationViewModel($collection, UniversityViewModel::class))
            ->toView('admin.universities.index', compact('countries'));
    }

    /**
     * @return View
     */

    public function create(): View
    {
        $countries = $this->countryService->getAll();
        $countries->transform(fn($country) => CountryViewModel::fromDataObject($country));

        $viewModel = UniversityViewModel::createEmpty();
        return $viewModel->toView('admin.universities.create', compact('countries'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $actionData):RedirectResponse
    {
        dd($actionData->all());
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
    public function edit(Request $request, int $id):View
    {

        $data = $this->service->edit($id);
        $viewModel = new UniversityViewModel($data);

        $countries = $this->countryService->getAll();
        $countries->transform(fn($country) => CountryViewModel::fromDataObject($country));
        $request->request->set('country_id', $data->country_id);
        $filters[] = CityFilter::getRequest($request);
        $cities = (new CityService())->getCitiesByCountryId($filters);
        $cities->transform(fn($city) => CityViewModel::fromDataObject($city));
        return $viewModel->toView('admin.universities.edit', compact('countries', 'cities'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UniversityActionData $actionData, int $id):RedirectResponse
    {
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
