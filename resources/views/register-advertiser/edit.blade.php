<x-app-layout>    
<div class="w-full flex justify-center items-center">
    <form method="POST" action="{{ route('profile.update-advertiser') }}" class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        @csrf
        @method('PATCH')

        <h1 class="text-lg font-medium text-gray-900 mb-2">Please confirm your credentials</h1>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Usage Type -->
        <div class="mt-4">
            <x-input-label for="user_type" :value="__('Usage Type')" />

            <div class="flex mt-1 space-x-4">
                <label class="flex items-center">
                    <input type="radio" name="user_type" value="private" class="form-radio" required>
                    <span class="ml-2">{{ __('Private') }}</span>
                </label>

                <label class="flex items-center">
                    <input type="radio" name="user_type" value="commercial" class="form-radio" required>
                    <span class="ml-2">{{ __('Commercial') }}</span>
                </label>
            </div>

            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
</x-app-layout>