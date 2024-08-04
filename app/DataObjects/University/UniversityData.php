<?php

namespace App\DataObjects\University;

use App\DataObjects\DataObjectBase;

class UniversityData extends DataObjectBase
{
    public int $id;
    public ?string $logo;
    public array $name;
    public ?string $country_name;
    public ?string $city_name;
    public int $country_id;
    public ?int $city_id;
    public string $description_uz;
    public ?string $description_ru;
    public ?string $description_en;
}
