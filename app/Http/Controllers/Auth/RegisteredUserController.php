<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed',],
            'type' => ['required', new Rules\Enum(UserTypeEnum::class), function ($attribute, $value, $fail) {
                if (UserTypeEnum::Admin->is(UserTypeEnum::tryFrom($value))) {
                    $fail(trans('validation.exists', ['attribute' => 'type']));
                }
            }],
        ]);
        $user = User::create(collect($data)->except('password_confirmation')->toArray());

        event(new Registered($user));

        Auth::login($user);

        return redirect(route($user->type->toString().'.dashboard'));
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }
}
