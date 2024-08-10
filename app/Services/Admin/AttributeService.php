<?php
declare(strict_types=1);

namespace App\Services\Admin;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Attribute\AttributeActionData;
use App\ActionData\Attribute\UpdateAttributeActionData;
use App\DataObjects\Attribute\AttributeData;
use App\Enums\AttributeType;
use App\Models\AttributeModel;
use Illuminate\Support\Collection;

class AttributeService
{
    /**
     * @param int $page
     * @param $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = null): DataObjectCollection
    {
        $model = AttributeModel::applyEloquentFilters($filters)
            ->orderBy('attributes.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (AttributeModel $attribute) {
            return AttributeData::createFromEloquentModel($attribute);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param AttributeActionData $actionData
     * @return AttributeData
     */
    public function store(AttributeActionData $actionData): AttributeData
    {
        $attribute = AttributeModel::query()->create($actionData->all());
        return AttributeData::fromModel($attribute);
    }

    /**
     * @param int $id
     * @return AttributeData
     * @throws \Exception
     */
    public function getOne(int $id):AttributeModel
    {
        return AttributeModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return AttributeData
     * @throws \Exception
     */
    public function edit(int $id): AttributeData
    {
        return AttributeData::fromModel($this->getOne($id));
    }

    /**
     * @param AttributeActionData $actionData
     * @param int $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function update(UpdateAttributeActionData $actionData, int $id): void
    {
        $attribute = $this->getOne($id);
        $attribute->fill($actionData->all());
        $attribute->save();
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        $attribute = $this->getOne($id);
        $attribute->delete();
    }

    /**
     * @param $type
     * @return AttributeModel|Collection
     */

    public function getAttributes(AttributeType $type):AttributeModel|Collection
    {
        $attributes = AttributeModel::query()
            ->where('type', '=', $type->value)
            ->get();
        return $attributes->transform(fn(AttributeModel $attributeModel) => AttributeData::fromModel($attributeModel));
    }
}
