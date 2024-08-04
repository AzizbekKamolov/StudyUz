<?php

namespace App\ActionData\University;

use App\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class UniversityActionData extends ActionDataBase
{
    public ?UploadedFile $logo = null;
    public ?array $name;
    public ?int $country_id;
    public ?int $city_id;
    public ?string $description_uz;
    public ?string $description_ru;
    public ?string $description_en;
    protected array $rules = [
        "name" => "required|array",
        "name.uz" => "required|string",
        "description_uz" => "required|string",
        "logo" => "nullable|mimes:jpg,jpeg,png,gif|max:10000",
        "country_id" => "required|exists:countries,id",
        "city_id" => "nullable|exists:cities,id",
    ];
}