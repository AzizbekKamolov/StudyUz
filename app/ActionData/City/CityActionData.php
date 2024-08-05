<?php
declare(strict_types=1);
namespace App\ActionData\City;


use Akbarali\ActionData\ActionDataBase;

class CityActionData extends ActionDataBase
{
    public ?array $name;
    public ?int $country_id;
    protected array $rules = [
        "name" => "required|array",
        "name.uz" => "required|string",
        "country_id" => "required|exists:countries,id",
    ];
}
