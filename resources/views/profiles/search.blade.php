
@extends('layouts.app')

@section('content')
    <div style="background-color: white;border: #f1cda3 10px dashed" class="container pb-3 pt-3">
        <div class="text-xl font-bold flex pb-3">Search Results:</div>
        @if(isset($users) && $users->count() > 0)
            @foreach($users as $user)
                <div class="flex align-items-center pb-3 pt-3">
                    @if(isset($user->profile->image))
                        <a href="/profile/{{$user->id}}">
                            <img src =" /storage/{{$user->profile->image}}" alt="profileimage" style="max-height: 40px; max-width: 40px" class="rounded-full ">
                        </a>
                    @endif
                    <h3 class="pl-3 pr-4 font-bold">
                        <a href="/profile/{{$user->id}}">{{$user->username}}</a>
                    </h3>
                </div>
                <hr>
            @endforeach
        @else
            <p>No results found.</p>
        @endif
    </div>
@endsection

