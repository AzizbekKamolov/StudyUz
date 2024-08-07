<?php
declare(strict_types=1);

namespace App\Filters\Trait;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait FilterTrait
 * @package App\Filters\Trait
 *
 * @method static Builder|static applyEloquentFilters(?iterable $filters = null, mixed $relations = null)
 * @method static Builder|static query()
 */
trait EloquentFilterTrait
{
    public function scopeApplyEloquentFilters(Builder $builder, ?iterable $filters = null, mixed $relations = null): Builder
    {
        if (!is_array($relations) && !is_null($relations) && $relations !== '') {
            $relations = array_slice(func_get_args(), 2);
        }

        if (is_array($relations) && count($relations) > 0) {
            $builder->with($relations);
        }

        if (!is_null($filters)) {
            foreach ($filters as $filter) {
                if ($filter instanceof EloquentFilterContract) {
                    $builder = $filter->applyEloquent($builder);
                }
            }
        }

        return $builder;
    }

}
