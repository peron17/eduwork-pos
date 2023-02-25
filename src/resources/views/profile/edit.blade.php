<x-app-layout>
    <x-header :title="__('navigation.edit profile')" />

    <x-card-form :route="route('profile.update')" :edit="true">
        <x-column sm="12" md="12" lg="8">

            <h3 class="display-5 mb-3">{{ __('general.profile') }}</h3>

            <x-field-horizontal :label="__('general.name')" :required="true" size="6">
                <input type="text" name="name" id="name" class="form-control" value="{{ @old('name') ?? $user->name }}" />
                @error('name')
                    <span class="message-alert">{{ $message }}</span>
                @enderror
            </x-field-horizontal>
        
            <x-field-horizontal :label="__('general.email')" :required="true" size="5">
                <input type="email" name="email" id="email" class="form-control" value="{{ @old('email') ?? $user->email }}" />
                @error('email')
                    <span class="message-alert">{{ $message }}</span>
                @enderror
            </x-field-horizontal>
        
            <h3 class="display-5 mb-3">{{ __('general.reset password') }}</h3>

            <x-field-horizontal :label="__('general.password')" :required="false" size="4">
                <input type="password" name="password" id="password" class="form-control" value="{{ @old('password') }}" />
                @error('password')
                    <span class="message-alert">{{ $message }}</span>
                @enderror
            </x-field-horizontal>
        
            <x-field-horizontal :label="__('general.retype password')" :required="false" size="4">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ @old('password_confirmation') }}" />
                @error('password_confirmation')
                    <span class="message-alert">{{ $message }}</span>
                @enderror
            </x-field-horizontal>

        </x-column>
    </x-card-form>
</x-app-layout>