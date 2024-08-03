<?php
declare(strict_types=1);

namespace App\DataObjects\City;

use App\DataObjects\Country\CountryData;
use App\DataObjects\DataObjectBase;
use Illuminate\Support\Carbon;

class CityData extends DataObjectBase
{
    public int $id;
    public int $country_id;
    public ?CountryData $country;
    public ?array $name;
    public Carbon $created_at;
}
