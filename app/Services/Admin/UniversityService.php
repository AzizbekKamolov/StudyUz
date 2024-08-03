<?php
declare(strict_types=1);

namespace App\Services\Admin;


use App\ActionData\University\UniversityActionData;
use App\DataObjects\DataObjectCollection;
use App\DataObjects\University\UniversityData;
use App\Models\UniversityModel;
use App\Utils\Phone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\ValidationException;

class UniversityService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null)
    {
        $model = UniversityModel::applyEloquentFilters($filters)
            ->orderBy('id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (UniversityModel $user) {
            return UniversityData::createFromEloquentModel($user);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param UniversityActionData $actionData
     * @return UniversityData
     * @throws ValidationException
     */
    public function store(UniversityActionData $actionData): UniversityData
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
        $user = UniversityModel::query()->create($data);
        $user->syncRoles($actionData->role_id);
        return UniversityData::fromModel($user);
    }

    /**
     * @param int $id
     * @return UniversityModel|Builder|Model
     */
    public function getOne(int $id):UniversityModel|Builder|Model
    {
        return UniversityModel::query()->with('roles')->findOrFail($id);
    }

    /**
     * @param int $id
     * @return UniversityData
     * @throws \Exception
     */
    public function edit(int $id): UniversityData
    {
        return UniversityData::fromModel($this->getOne($id));
    }

    /**
     * @param UniversityActionData $actionData
     * @param int $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function update(UniversityActionData $actionData, int $id): UniversityData
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

        $user = UniversityModel::query()->findOrFail($id);
        $user->syncRoles($actionData->role_id);
        $user = $this->getOne($id);
        $user->fill($data);
        $user->save();
        $user->syncRoles($actionData->role_id);
        return UniversityData::fromModel($user);
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
