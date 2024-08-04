<?php
declare(strict_types=1);

namespace App\Services\Admin;

use App\ActionData\Country\CountryActionData;
use App\DataObjects\Country\CountryData;
use App\DataObjects\DataObjectCollection;
use App\Models\CountryModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CountryService
{
    /**
     * @param int $page
     * @param $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = CountryModel::applyEloquentFilters($filters)
            ->orderBy('id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (CountryModel $country) {
            return CountryData::createFromEloquentModel($country);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param CountryActionData $actionData
     * @return CountryData
     */
    public function store(CountryActionData $actionData): CountryData
    {
        $country = CountryModel::query()->create($actionData->all());
        return CountryData::fromModel($country);
    }

    /**
     * @param int $id
     * @return Model|Builder|Collection
     */
    public function getOne(int $id): Model|Builder|Collection
    {
        return CountryModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return CountryData
     * @throws \Exception
     */
    public function edit(int $id): CountryData
    {
        return CountryData::fromModel($this->getOne($id));
    }

    /**
     * @param CountryActionData $actionData
     * @param int $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function update(CountryActionData $actionData, int $id): void
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

    public function getAll()
    {
        $countries = CountryModel::query()->get();
        return $countries->transform(fn(CountryModel $country) => CountryData::fromModel($country));
    }

}
