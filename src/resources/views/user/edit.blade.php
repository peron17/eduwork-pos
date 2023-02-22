<x-app-layout>
    <x-header :title="__('button.edit user')">
        <x-header-button-delete :href="route('user.destroy', $user->id)" :redirect="route('user.index')" :title="__('button.delete user')" icon="fa-trash" />
        <x-header-button :href="route('user.create')" :title="__('button.create user')" icon="fa-plus" :modal="false" />
        <x-header-button :href="route('user.index')" :title="__('button.list user')" icon="fa-list-alt" :modal="false" />
    </x-header>

    <x-card-form :route="route('user.update', $user->id)" :edit="true">
        <x-column sm="12" md="8" lg="8">
            <h3 class="display-5 mb-3">{{ __('general.profile') }}</h3>

            <x-field-horizontal :label="__('general.name')" :required="true" size="6">
                <input type="text" name="name" id="name" class="form-control" value="{{  @old('name') ?  @old('name') : $user->name }}" />
                @error('name')
                    <span class="message-alert">{{ $message }}</span>
                @enderror
            </x-field-horizontal>
        
            <x-field-horizontal :label="__('general.email')" :required="true" size="5">
                <input type="email" name="email" id="email" class="form-control" value="{{ @old('email') ? @old('email') : $user->email }}" />
                @error('email')
                    <span class="message-alert">{{ $message }}</span>
                @enderror
            </x-field-horizontal>
        
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

            <x-field-horizontal :label="__('general.status')" :required="true" size="4">
                <div class="form-check">
                    <input class="form-check-input" value="1" type="radio" name="status" id="status1" {{ $user->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="status1">
                        {{ __('general.active') }}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" value="0" type="radio" name="status" id="status2"  {{ !$user->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="status2">
                        {{ __('general.inactive') }}
                    </label>
                </div>

                @error('is_active')
                    <span class="message-alert">{{ $message }}</span>
                @enderror
            </x-field-horizontal>
            
            <hr>

            <h3 class="display-5 mb-3">{{ __('general.role') }}</h3>

            <x-field-horizontal :label="__('general.role')" :required="false" size="4">
                <select name="role" class="form-select form-control" aria-label="Default select example">
                    <option selected>{{ __('general.select') }}</option>
                    @foreach ($roles as $key => $role)
                        @if (old('role') == $key || $user->hasRole($key))
                            <option value="{{ $key }}" selected>{{ $role }}</option>
                        @else
                            <option value="{{ $key }}">{{ $role }}</option>
                        @endif
                    @endforeach
                </select>

                @error('role')
                    <span class="message-alert">{{ $message }}</span>
                @enderror
            </x-field-horizontal>

            <hr>

            <h3 class="display-5 mb-3">{{ __('general.permission') }}</h3>

            <x-field-horizontal :label="__('general.permission')" :required="false" size="6">
                @if (empty($permissions))
                    <div class="alert alert-warning">Permission not found</div>
                @else
                    @foreach ($permissions as $group => $permission)
                        <h5 class="display-6 font-weight-bold">{{ $group }}</h4>
                        <div class="row">
                            @foreach ($permission as $id => $item)
                                <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
                                    <div class="form-check">
                                        @if ((!empty(old('permissions')) && in_array($id, old('permissions'))) || $user->hasPermissionTo($id))
                                            <input class="form-check-input" name="permissions[]" type="checkbox" value="{{ $id }}" id="{{ 'permission-' . $id }}" checked>
                                        @else
                                            <input class="form-check-input" name="permissions[]" type="checkbox" value="{{ $id }}" id="{{ 'permission-' . $id }}">
                                        @endif
                                        <label class="form-check-label" for="{{ 'permission-' . $id }}">
                                            {{ $item['name'] }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </x-field-horizontal>

        </x-column>
    </x-card-form>
  
</x-app-layout>
