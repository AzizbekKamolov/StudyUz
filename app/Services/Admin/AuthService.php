<?php
declare(strict_types=1);

namespace App\Services\Admin;


use App\ActionData\Auth\LoginUserActionData;
use App\Models\User;
use App\Utils\Phone;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * @param LoginUserActionData $actionData
     * @return void
     * @throws ValidationException
     */
    public function loginUser(LoginUserActionData $actionData): void
    {
        $phone = new Phone($actionData->username);
        $user = User::query()
            ->where('email', $actionData->username)
            ->orWhere('phone', $phone->getFull())
            ->first();
        if (is_null($user)) {
            throw ValidationException::withMessages([
                "username" => "Foydalanuvchi mavjud emas"
            ]);
        }
        if (!Hash::check($actionData->password, $user->password)) {
            throw ValidationException::withMessages([
                "password" => "Parol xato"
            ]);
        }
        auth()->login($user);
    }
}
