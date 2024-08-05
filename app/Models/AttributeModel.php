<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property array $name
 * @property int $type
 * @property string $created_at
 */
class AttributeModel extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'attributes';

    protected $fillable = [
      'name',
      'type',
      'created_at',
      'updated_at',
    ];
    protected $casts = [
      "name" => "array"
    ];
}
