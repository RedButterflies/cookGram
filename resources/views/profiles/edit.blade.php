@extends('layouts.app')

@section('content')
    <div class="container pb-3" style="background-color: white; border: #f1cda3 10px dashed">
        <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-8 offset-1">
                    <div class="row">
                        <h1 class="text-3xl pt-3">Edit Profile</h1>
                    </div>
                    <div class="form-group row pt-3">
                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title') ?? $user->profile->title" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>

                    <div class="form-group row pt-3">
                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description') ?? $user->profile->description" required />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="form-group row pt-3">
                        <!-- URL -->
                        <div>
                            <x-input-label for="url" :value="__('URL')" />
                            <x-text-input id="url" class="block mt-1 w-full" type="text" name="url" :value="old('url') ??  $user->profile->url" required autocomplete="url" />
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row pt-3">
                        <x-input-label for="image" :value="__('Profile Image')" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        <input type="file" class="form-control-file pl-3" id="image" name="image">
                    </div>

                    <div class="pt-4 block mt-1">
                        <button class="btn btn-primary">Save Profile</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="col-8 offset-1 flex mt-8">
            <a href="{{ route('email.change') }}" class="btn" style="background-color: lightgreen; color: white">
                Change Email
            </a>
        </div>

        <div class="col-8 offset-1 flex mt-8">
            <a href="{{ route('password.change') }}" class="btn" style="background-color: lightgreen; color: white">
                Change Password
            </a>
        </div>

        <div class="col-8 offset-1 flex mt-8">
            <a class="text-red-500" href="{{ route('profile.delete.confirmation', ['user' => $user]) }}">Delete Profile</a>
        </div>
    </div>
@endsection
