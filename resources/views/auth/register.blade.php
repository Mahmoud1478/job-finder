@php use App\Enums\UserTypeEnum; @endphp
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <div class="flex gap-3.5">
                @foreach(UserTypeEnum::cases() as $type)
                    @if($type->isNot(UserTypeEnum::Admin))
                        <div class="flex flex-1 items-center ps-4 border mb-2 border-gray-200 rounded">
                            <input id="type-{{$type->toString()}}" type="radio" value="{{$type->value}}" name="type"
                                   @checked(old('type', 1) == $type->value)
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500   focus:ring-2">
                            <label for="type-{{$type->toString()}}"
                                   class="w-full py-4 ms-2 text-sm font-medium text-gray-900">{{$type->toString()->ucfirst()}}</label>
                        </div>
                    @endif
                @endforeach
            </div>
            <x-input-error :messages="$errors->get('type')" class="mt-2"/>
        </div>
        <div class="">
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                          autofocus autocomplete="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>
        <div class="mt-4">
            <x-input-label for="email" :value="__('Phone')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                          autocomplete="phone"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
