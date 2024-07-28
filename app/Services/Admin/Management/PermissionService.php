<?php
declare(strict_types=1);

namespace App\Services\Admin\Management;

use App\ActionData\Management\Permission\StorePermissionActionData;
use App\ActionData\Management\Permission\UpdatePermissionActionData;
use App\DataObjects\DataObjectCollection;
use App\DataObjects\Management\Permission\PermissionData;
use App\Models\Management\Permission;

class PermissionService
{
    /**
     * @param int $page
     * @param $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = Permission::applyEloquentFilters($filters)
            ->orderBy('permissions.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Permission $permission) {
            return PermissionData::createFromEloquentModel($permission);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param StorePermissionActionData $actionData
     * @return PermissionData
     */
    public function store(StorePermissionActionData $actionData): PermissionData
    {
        $permission = Permission::query()->create($actionData->all());
        return PermissionData::fromModel($permission);
    }

    /**
     * @param int $id
     * @return PermissionData
     * @throws \Exception
     */
    public function getOne(int $id):Permission
    {
        return Permission::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return PermissionData
     * @throws \Exception
     */
    public function edit(int $id):PermissionData
    {
        return PermissionData::fromModel($this->getOne($id));
    }

    /**
     * @param UpdatePermissionActionData $actionData
     * @param int $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function update(UpdatePermissionActionData $actionData, int $id):void
    {
        $actionData->addValidationRule('name', "unique:permissions,name,$id");
        $actionData->validateException();
        $permission = $this->getOne($id);
        $permission->fill($actionData->all());
        $permission->save();
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function delete(int $id):void
    {
        $permission = $this->getOne($id);
        $permission->delete();
    }

}
