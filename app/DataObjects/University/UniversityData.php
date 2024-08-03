<?php

namespace App\DataObjects\University;

use App\DataObjects\DataObjectBase;

class UniversityData extends DataObjectBase
{
    public ?string $logo;
    public ?array $name;
    public ?int $region_id;
    public ?int $city_id;
    public ?string $description_uz;
    public ?string $description_ru;
    public ?string $description_en;
}
