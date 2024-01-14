@extends('layouts.app')

@section('content')
    <div style="background-color: white;border: #f1cda3 10px dashed" class="container pt-3 pb-3">
        <h2>Change Email</h2>

        <form method="post" action="{{ route('email.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div>
                <x-input-label for="new_email" :value="__('New Email')" />
                <x-text-input id="new_email" name="new_email" type="email" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->first('new_email')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'email-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Email updated successfully.') }}</p>
                @endif
            </div>
        </form>
    </div>
@endsection
