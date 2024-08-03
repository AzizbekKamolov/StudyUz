<?php
declare(strict_types=1);

namespace App\ViewModels\University;

use App\ViewModels\BaseViewModel;

class UniversityViewModel extends BaseViewModel
{
    public ?string $logo;
    public ?array $name;
    public ?int $region_id;
    public ?int $city_id;
    public ?string $description_uz;
    public ?string $description_ru;
    public ?string $description_en;
    protected function populate(): void
    {
    }
}
