<?php
declare(strict_types=1);

namespace App\ViewModels\University;

use App\ViewModels\BaseViewModel;

class UniversityViewModel extends BaseViewModel
{
    public string $id;
    public ?string $logo;
    public array $name;
    public ?string $name_uz;
    public ?string $name_ru;
    public ?string $name_en;
    public ?string $nameTr;
    public int $country_id;
    public ?string $country_name;
    public ?string $city_name;
    public ?int $city_id;
    public string $description_uz;
    public ?string $description_ru;
    public ?string $description_en;

    protected function populate(): void
    {
        $this->nameTr = $this->trans($this->name);
        $this->name_uz = $this->trans($this->name, 'uz');
        $this->name_ru = $this->trans($this->name, 'ru');
        $this->name_en = $this->trans($this->name, 'en');
        if ($this->country_name) {
            $this->country_name = $this->trans($this->country_name);
        }
        if ($this->city_name) {
            $this->city_name = $this->trans($this->city_name);
        }
    }
}
