@extends('layouts.app', ['logo' => true])

@section('content')
    @component('components.settings', ['option' => 1])
        @slot('form')
            <form class="row justify-content-center" method="POST" action="{{ route('password.update') }}">
                @csrf

                @if(session('status'))
                    <div class="alert d-block alert-success col-8" role="alert">
                        <strong>{{ trans("settings.message_success") }}</strong>
                    </div>
                @endif

                <div class="form-group col-8 p-0">
                    <input type="password" id="currentpassword" name="currentpassword" placeholder="{{ __('Current password') }}"
                    class="form-control{{ $errors->has('currentpassword') ? ' is-invalid' : '' }}" required>

                    @if ($errors->has('currentpassword'))
                    <span class="alert d-block mt-1 alert-danger" role="alert">
                        <strong>{{ $errors->first('currentpassword') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-8 p-0">
                    <input id="password" type="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        placeholder="{{ __('New password') }}" required>

                    @if ($errors->has('password'))
                    <span class="alert d-block mt-1 alert-danger" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-8 p-0">
                    <input id="password-confirm" type="password" class="form-control"
                        name="password_confirmation"
                        placeholder="{{ __('Confirm new password') }}" required>
                </div>

                <div class="form-group col-8 m-0 p-0">
                    <button type="submit" class="form-btn">
                        {{ __('Change password') }}
                    </button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection