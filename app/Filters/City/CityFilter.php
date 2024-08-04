<?php
declare(strict_types=1);

namespace App\Filters\City;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CityFilter implements EloquentFilterContract
{
    public function __construct(
        protected Request $request
    )
    {
    }

    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('name')) {
            $model->where('name', 'like', '%' . $this->request->get('name') . '%');
        }
        if ($this->request->get('country_id')) {
            $model->where('country_id', '=', $this->request->get('country_id'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
