@extends('layouts.app')

@section('content')
    <div style="border:#fef3c7 10px dashed; background-color: white;" class="container pb-3 ">
        <form action="/p/{{$post->id}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-8 offset-1">
                    <div class="row">
                        <h1 class="text-3xl pt-3">Edit Post Caption</h1>
                    </div>
                    <div class="form-group row pt-3">
                        <!-- Caption-->
                        <div>
                            <x-input-label for="caption" :value="__('Post Caption')" />
                            <x-text-input id="caption" class="block mt-1 w-full" type="text" name="caption" :value="old('caption')" required autofocus maxlength="255" />
                            <x-input-error :messages="$errors->get('caption')" class="mt-2" />
                        </div>
                    </div>
                    <div class="pt-4 block mt-1 ">
                        <button class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
