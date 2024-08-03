<?php

namespace App\ActionData\University;

use App\ActionData\ActionDataBase;

class UniversityActionData extends ActionDataBase
{
    public ?string $logo;
    public ?array $name;
    public ?int $region_id;
    public ?int $city_id;
    public ?string $description_uz;
    public ?string $description_ru;
    public ?string $description_en;
    protected array $rules = [
        "name" => "required|array",
        "name.uz" => "required|string",
        "description_uz" => "required|string"
    ];
}
