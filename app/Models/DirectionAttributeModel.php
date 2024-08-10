<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property int $direction_id;
 * @property int $attribute_id;
 * @property string $value;
 * @property string $created_at;
 * @property string $updated_at;
 */
class DirectionAttributeModel extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'university_attributes';
    protected $fillable = [
        'direction_id',
        'attribute_id',
        'value',
        'created_at',
        'updated_at',
    ];
}
