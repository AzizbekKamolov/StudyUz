<?php
declare(strict_types=1);

namespace App\Services\Admin;

use App\ActionData\City\CityActionData;
use App\DataObjects\City\CityData;
use App\DataObjects\DataObjectCollection;
use App\Models\CityModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CityService
{
    /**
     * @param int $page
     * @param $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = null): DataObjectCollection
    {
        $model = CityModel::applyEloquentFilters($filters)
            ->with('country')
            ->orderBy('id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (CityModel $country) {
            return CityData::fromModel($country);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param CityActionData $actionData
     * @return CityData
     */
    public function store(CityActionData $actionData): CityData
    {
        $country = CityModel::query()->create($actionData->all());
        return CityData::fromModel($country);
    }

    /**
     * @param int $id
     * @return Model|Builder|Collection
     */
    public function getOne(int $id): Model|Builder|Collection
    {
        return CityModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return CityData
     * @throws \Exception
     */
    public function edit(int $id): CityData
    {
        return CityData::fromModel($this->getOne($id));
    }

    /**
     * @param CityActionData $actionData
     * @param int $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function update(CityActionData $actionData, int $id): void
    {
        $country = $this->getOne($id);
        $country->fill($actionData->all());
        $country->save();
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        $country = $this->getOne($id);
        $country->delete();
    }

    /**
     * @param iterable|null $filters
     * @return Model|Builder|Collection
     */
    public function getCitiesByCountryId(?iterable $filters = null):Model|Builder|Collection
    {
        $items = CityModel::applyEloquentFilters($filters)->get();

        return $items->transform(function (CityModel $country) {
            return CityData::fromModel($country);
        });
    }

}
