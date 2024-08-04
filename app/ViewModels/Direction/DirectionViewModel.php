<?php
declare(strict_types=1);

namespace App\ViewModels\Direction;

use App\DataObjects\Country\CountryData;
use App\DataObjects\University\UniversityData;
use App\ViewModels\BaseViewModel;
use Illuminate\Support\Carbon;

class DirectionViewModel extends BaseViewModel
{

    public int $id;
    public array $name;
    public ?string $nameTr;
    public array $requirement;
    public ?string $requirementTr;
    public array $contract_currency;
    public ?string $contract_currency_tr;
    public int $contract_amount;
    public int $university_id;
    public ?UniversityData $university;
    public ?string $universityName;

    protected function populate(): void
    {
     $this->nameTr = $this->trans($this->name);
     $this->requirementTr = $this->trans($this->requirement);
     $this->contract_currency_tr = $this->trans($this->contract_currency);
     if ($this->university){
         $this->universityName = $this->trans($this->university->name);
     }
    }
}
