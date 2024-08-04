<?php
declare(strict_types=1);

namespace App\Services\Admin;

use App\ActionData\Direction\DirectionActionData;
use App\DataObjects\DataObjectCollection;
use App\DataObjects\Direction\DirectionData;
use App\Models\DirectionModel;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class DirectionService
{
    /**
     * @param int $page
     * @param $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = DirectionModel::applyEloquentFilters($filters)
            ->orderBy('directions.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (DirectionModel $direction) {
            return DirectionData::createFromEloquentModel($direction);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param DirectionActionData $actionData
     * @return DirectionData
     */
    public function store(DirectionActionData $actionData): DirectionData
    {
        $direction = DirectionModel::query()->create($actionData->all());
        return DirectionData::fromModel($direction);
    }

    public function getOne(int $id): Model|Collection|Builder|null
    {
        return DirectionModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return DirectionData
     * @throws \Exception
     */
    public function edit(int $id): DirectionData
    {
        return DirectionData::fromModel($this->getOne($id));
    }

    /**
     * @param DirectionActionData $actionData
     * @param int $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function update(DirectionActionData $actionData, int $id): void
    {
        $actionData->addValidationRule('name', "unique:roles,name,$id");
        $actionData->validateException();
        $direction = $this->getOne($id);
        $direction->fill($actionData->all());
        $direction->save();
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        $direction = $this->getOne($id);
        $direction->delete();
    }

}
