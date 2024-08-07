<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @property int $id
 * @property int $country_id
 * @property array $name
 * @property string $created_at
 */
class CityModel extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $table = 'cities';
    protected $fillable = [
        'name',
        'country_id',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        "name" => "array"
    ];

    public function country():BelongsTo
    {
        return $this->belongsTo(CountryModel::class, 'country_id');
    }
}
