<?php
declare(strict_types=1);

namespace App\Filters\Management\User;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserFilter implements EloquentFilterContract
{
    public function __construct(
        protected Request $request
    )
    {
    }

    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('last_name')) {
            $model->where('last_name', 'like', '%' . $this->request->get('last_name') . '%');
        }
        if ($this->request->has('first_name')) {
            $model->where('first_name', 'like', '%' . $this->request->get('first_name') . '%');
        }
        if ($this->request->has('phone')) {
            $model->where('phone', 'like', '%' . $this->request->get('phone') . '%');
        }
        if ($this->request->has('email')) {
            $model->where('email', 'like', '%' . $this->request->get('email') . '%');
        }
        if ($this->request->has('role_id')) {
            $model->whereHas('roles', function ($query){
                $query->where('id', '=', $this->request->get('role_id'));
            });
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
