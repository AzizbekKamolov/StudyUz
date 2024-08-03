<?php
declare(strict_types=1);

namespace App\Services\Admin;


use App\ActionData\Auth\LoginUserActionData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{

    public function loginUser(LoginUserActionData $actionData): void
    {
        $user = User::query()
            ->where('phone', $actionData->username)
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
