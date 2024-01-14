@extends('layouts.app')

@section('content')
    <div style="background-color: white;border: #f1cda3 10px dashed" class="container pb-3">
        <form action="/p" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-1">
                    <div class="row">
                        <h1 class="text-3xl pt-3">Add New Post</h1>
                    </div>
                    <div class="form-group row pt-3">
                        <!-- Caption-->
                        <div>
                            <x-input-label for="caption" :value="__('Post Caption')" />
                            <x-text-input id="caption" class="block mt-1 w-full" type="text" name="caption" :value="old('caption')" required autofocus  maxlength="255" />
                            <x-input-error :messages="$errors->get('caption')" class="mt-2" />
                        </div>
                    </div>


                    <div class="row pt-3">
                        <x-input-label for="image" :value="__('Post Image')" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        <input type="file" class="form-control-file pl-3" id ="image" name="image">
                    </div>
                    <div class="pt-4 block mt-1 ">
                        <button class="btn btn-primary">Add New Post</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
