<?php
declare(strict_types=1);

namespace App\Filters\University;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UniversityFilter implements EloquentFilterContract
{
    public function __construct(
        protected Request $request
    )
    {
    }

    public function applyEloquent(Builder $model): Builder
    {
        $locale = app()->getLocale();
        if ($this->request->has('name')) {
            $model->whereRaw('LOWER(JSON_EXTRACT(universities.name, "$.'.$locale.'")) like ?', ['"%' . strtolower($this->request->get('name')) . '%"']);
//            $model->where("universities.name->$locale", 'like', '%' . $this->request->get('name') . '%');
        }
        if ($this->request->has('country_id')) {
            $model->where("universities.country_id", '=', $this->request->get('country_id'));
        }
        if ($this->request->has('city_id')) {
            $model->where("universities.city_id", '=', $this->request->get('city_id'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
