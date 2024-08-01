<?php
declare(strict_types=1);

namespace App\Services\Admin\Management;

use App\ActionData\Management\User\StoreUserActionData;
use App\ActionData\Management\User\UpdateUserActionData;
use App\DataObjects\DataObjectCollection;
use App\DataObjects\Management\User\UserData;
use App\Models\User;
use App\Utils\Phone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\ValidationException;

class UserService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null)
    {
        $model = User::applyEloquentFilters($filters)
            ->with('roles')
            ->orderBy('users.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (User $user) {
            return UserData::createFromEloquentModel($user);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param StoreUserActionData $actionData
     * @return UserData
     * @throws ValidationException
     */
    public function store(StoreUserActionData $actionData): UserData
    {
        $phone = new Phone($actionData->phone);
        if (!$phone->validate()){
            throw ValidationException::withMessages(['phone' => trans("validation.not_regex", [
                'attribute' => 'phone'
            ])]);
        }
        $data = $actionData->all();
        unset($data['role_id']);
        $data['phone'] = $phone->getFull();
        $data['password'] = bcrypt($actionData->password);
        $user = User::query()->create($data);
        $user->syncRoles($actionData->role_id);
        return UserData::fromModel($user);
    }

    /**
     * @param int $id
     * @return User|Builder|Model
     */
    public function getOne(int $id):User|Builder|Model
    {
        return User::query()->with('roles')->findOrFail($id);
    }

    /**
     * @param int $id
     * @return UserData
     * @throws \Exception
     */
    public function edit(int $id): UserData
    {
        return UserData::fromModel($this->getOne($id));
    }

    /**
     * @param UpdateUserActionData $actionData
     * @param int $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function update(UpdateUserActionData $actionData, int $id): UserData
    {
        $phone = new Phone($actionData->phone);
        if (!$phone->validate()){
            throw ValidationException::withMessages(['phone' => trans("validation.not_regex", [
                'attribute' => 'phone'
            ])]);
        }
        $actionData->phone = $phone->getFull();
        $actionData->addValidationRule('email', "unique:users,email,$id");
        $actionData->addValidationRule('phone', "unique:users,phone,$id");
        $actionData->validateException();

        $data = $actionData->all();
        unset($data['role_id']);
        unset($data['password']);
        if (isset($actionData->password)){
            $data['password'] = bcrypt($actionData->password);
        }

        $user = User::query()->findOrFail($id);
        $user->syncRoles($actionData->role_id);
        $user = $this->getOne($id);
        $user->fill($data);
        $user->save();
        $user->syncRoles($actionData->role_id);
        return UserData::fromModel($user);
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        $user = $this->getOne($id);
        $user->delete();
    }

}
