<?php
declare(strict_types=1);

namespace App\Filters\Direction;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DirectionFilter implements EloquentFilterContract
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
           $model->where("name->$locale", 'like', '%' . $this->request->get('name') . '%');
        }
        if ($this->request->has('contract_currency')) {
            $model->where("contract_currency->$locale", 'like', '%' . $this->request->get('contract_currency') . '%');
        }
        if ($this->request->has('university_id')) {
            $model->where('university_id', '=', $this->request->get('university_id'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
