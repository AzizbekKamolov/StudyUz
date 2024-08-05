<?php
declare(strict_types=1);

namespace App\ViewModels\Direction;


use Akbarali\ViewModel\BaseViewModel;

class DirectionViewModel extends BaseViewModel
{

    public int $id;
    public array $name;
    public ?string $nameTr;
    public ?string $name_uz;
    public ?string $name_ru;
    public ?string $name_en;
    public array $requirement;
    public ?string $requirementTr;
    public ?string $requirement_uz;
    public ?string $requirement_ru;
    public ?string $requirement_en;
    public array $contract_currency;
    public ?string $contract_currency_tr;
    public ?string $contract_currency_uz;
    public ?string $contract_currency_ru;
    public ?string $contract_currency_en;
    public int $contract_amount;
    public int $university_id;
    public  $university = '';
    public ?string $universityName;

    protected function populate(): void
    {
     $this->nameTr = $this->trans($this->name);
     $this->name_uz = $this->trans($this->name, 'uz');
     $this->name_ru = $this->trans($this->name, 'ru');
     $this->name_en = $this->trans($this->name, 'en');
     $this->requirementTr = $this->trans($this->requirement);
     $this->requirement_uz = $this->trans($this->requirement, 'uz');
     $this->requirement_ru = $this->trans($this->requirement, 'ru');
     $this->requirement_en = $this->trans($this->requirement, 'en');
     $this->contract_currency_tr = $this->trans($this->contract_currency);
     $this->contract_currency_uz = $this->trans($this->contract_currency, 'uz');
     $this->contract_currency_ru = $this->trans($this->contract_currency, 'ru');
     $this->contract_currency_en = $this->trans($this->contract_currency, 'en');
     if ($this->university){
         $this->universityName = $this->trans($this->university->name);
     }
    }
}
