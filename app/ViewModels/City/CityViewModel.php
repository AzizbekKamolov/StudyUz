<?php
declare(strict_types=1);

namespace App\ViewModels\City;

use App\DataObjects\Country\CountryData;
use App\ViewModels\BaseViewModel;
use Illuminate\Support\Carbon;

class CityViewModel extends BaseViewModel
{

    public int $id;
    public string|array $name;
    public ?string $nameTr;
    public ?string $name_uz;
    public ?string $name_ru;
    public ?string $name_en;
    public ?Carbon $created_at;
    public int $country_id;
    public ?CountryData $country;
    public ?string $countryName;

    protected function populate(): void
    {
        $this->nameTr = $this->trans($this->name);
        $this->name_uz = $this->trans($this->name, 'uz');
        $this->name_ru = $this->trans($this->name, 'ru');
        $this->name_en = $this->trans($this->name, 'en');
        if ($this->country){
            $this->countryName = $this->trans($this->country->name);
        }
    }
}
