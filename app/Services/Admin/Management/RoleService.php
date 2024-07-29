<?php
declare(strict_types=1);

namespace App\Services\Admin\Management;

use App\ActionData\Management\Role\StoreRoleActionData;
use App\ActionData\Management\Role\UpdateRoleActionData;
use App\DataObjects\DataObjectCollection;
use App\DataObjects\Management\Role\RoleData;
use App\Models\Management\Role;

class RoleService
{
    /**
     * @param int $page
     * @param $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = Role::applyEloquentFilters($filters)
            ->orderBy('roles.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Role $role) {
            return RoleData::createFromEloquentModel($role);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param StoreRoleActionData $actionData
     * @return RoleData
     */
    public function store(StoreRoleActionData $actionData): RoleData
    {
        $role = Role::query()->create([
            "name" => $actionData->name,
            "guard_name" => $actionData->guard_name,
        ]);
        $role->syncPermissions($actionData->permission_id);
        return RoleData::fromModel($role);
    }

    /**
     * @param int $id
     * @return RoleData
     * @throws \Exception
     */
    public function getOne(int $id): Role
    {
        return Role::query()->with('permissions')->findOrFail($id);
    }

    /**
     * @param int $id
     * @return RoleData
     * @throws \Exception
     */
    public function edit(int $id): RoleData
    {
        return RoleData::fromModel($this->getOne($id));
    }

    /**
     * @param UpdateRoleActionData $actionData
     * @param int $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function update(UpdateRoleActionData $actionData, int $id): void
    {
        $actionData->addValidationRule('name', "unique:roles,name,$id");
        $actionData->validateException();
        $role = $this->getOne($id);
        $role->fill($actionData->all());
        $role->save();
        $role->syncPermissions($actionData->permission_id);
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        $role = $this->getOne($id);
        $role->delete();
    }

}
