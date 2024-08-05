<?php
declare(strict_types=1);

namespace App\Filters\Attribute;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AttributeFilter implements EloquentFilterContract
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
        if ($this->request->has('type') && $this->request->get('type')) {
            $model->where("type", '=', $this->request->get('type'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
