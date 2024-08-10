<?php
declare(strict_types=1);

namespace App\Services\Admin;


use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\University\UniversityActionData;
use App\DataObjects\University\UniversityData;
use App\Models\UniversityAttributeModel;
use App\Models\UniversityModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UniversityService
{
    const IMAGE_PATH = "logos/";

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = UniversityModel::applyEloquentFilters($filters)
            ->leftJoin('countries', 'countries.id', 'universities.country_id')
            ->leftJoin('cities', 'cities.id', 'universities.city_id')
            ->select([
                'universities.*',
                'countries.name as country_name',
                'cities.name as city_name',
            ])
            ->orderBy('id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (UniversityModel $university) {
            return UniversityData::fromModel($university);
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
        $actionData->addValidationRule('logo', 'required');
        $actionData->validateException();

        $data = $actionData->all();
        unset($data['attributes']);
        if ($actionData->logo) {
            $imageName = Str::uuid(10) . '.' . $actionData->logo->getClientOriginalExtension();
            $actionData->logo->move(public_path(self::IMAGE_PATH), $imageName);
            $data['logo'] = $imageName;
        }
        $university = UniversityModel::query()->create($data);
        $attributes = [];
        foreach ($actionData->attributes as $attribute) {
            if (!isset($attribute['attribute_id']) || !$attribute['value']) {
                continue;
            }
            $item['attribute_id'] = $attribute['attribute_id'];
            $item['university_id'] = $university->id;
            $item['value'] = $attribute['value'];
            $attributes[] = $item;
            $item = [];
        }
        UniversityAttributeModel::query()->insert($attributes);

        return UniversityData::fromModel($university);
    }

    /**
     * @param int $id
     * @return UniversityModel|Builder|Model
     */
    public function getOne(int $id): UniversityModel|Builder|Model
    {
        return UniversityModel::query()->with('university_attributes')->findOrFail($id);
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
        $attributes = array_column($actionData->attributes, 'id');
        foreach ($actionData->attributes as $attribute) {
            if (!isset($attribute['id']) || !$attribute['value']) {
                continue;
            }
            $university_attribute = UniversityAttributeModel::query()
                ->where('university_id', '=', $id)
                ->first();
        }

        $data = $actionData->all();
        $university = $this->getOne($id);
        unset($data['logo']);
        if ($actionData->logo) {
            $imageName = Str::uuid(10) . '.' . $actionData->logo->getClientOriginalExtension();
            $actionData->logo->move(public_path(self::IMAGE_PATH), $imageName);
            $data['logo'] = $imageName;
            if (file_exists(public_path(self::IMAGE_PATH . $university->logo))) {
                unlink(public_path(self::IMAGE_PATH . $university->logo));
            }
        }

        $university->fill($data);
        $university->save();
        return UniversityData::fromModel($university);
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        $university = $this->getOne($id);
        if (file_exists(public_path(self::IMAGE_PATH . $university->logo))) {
            unlink(public_path(self::IMAGE_PATH . $university->logo));
        }
        $university->delete();
    }

    /**
     * @return UniversityModel|Collection
     */
    public function getAllUniversities(): UniversityModel|Collection
    {
        $universities = UniversityModel::query()
            ->get();
        return $universities->transform(fn(UniversityModel $model) => UniversityData::fromModel($model));
    }
}
