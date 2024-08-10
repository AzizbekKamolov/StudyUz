<?php
declare(strict_types=1);
namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

/**
 * @property int $id
 * @property string $logo
 * @property array $name
 * @property int $country_id
 * @property int $city_id
 * @property string $description_uz
 * @property ?string $description_ru
 * @property ?string $description_en
 * @property string $created_at
 */
class UniversityModel extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'universities';
    protected $fillable = [
      'logo',
      'name',
      'country_id',
      'city_id',
      'description_uz',
      'description_ru',
      'description_en',
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
    public function city():BelongsTo
    {
        return $this->belongsTo(CityModel::class, 'city_id');
    }
    public function university_attributes():HasMany
    {
        return $this->hasMany(UniversityAttributeModel::class, 'university_id');
    }
}
