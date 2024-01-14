@extends('layouts.app')

@section('content')
    <div style="background-color: white;border: #fef3c7 10px dashed" class="container">
        <div  class="row pb-6">
            <div class="col-3 pt-5">
                <img src="{{$user->profile->profileImage()}}" style="height: 110px; width: 110px" alt="picture" class="rounded-full">
            </div>
            <div  class="col-9 pt-5">
                <div class="flex  justify-content-between align-items-baseline">
                    <div id="app" class="flex justify-content-between align-items-baseline pb-4">
                        <h1 class="text-3xl">{{$user->username}}</h1>

                        @if(auth()->user() && auth()->user()->id !== $user->id)
                            <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                        @endif
                    </div>

                    @can('update', $user->profile)
                        <a class="text-blue-300" href="/p/create">Add New Post</a>
                    @endcan

                </div>
                @can('update', $user->profile)
                    <a class="text-blue-300" href="/profile/{{$user->id}}/edit">Edit Profile</a>
                @endcan
                <div class="flex">
                    <div class="pr-3"><strong>{{$postCount}}</strong> posts</div>
                    <div class="pr-3"><strong>{{$followersCount}}</strong> followers</div>
                    <div class="pr-3"><strong>{{$followingCount}}</strong> following</div>
                </div>
                <div class="pt-4 font-bold text-sm">{{$user->profile->title}}</div>
                <div class="pt-1 text-sm">{{$user->profile->description}}</div>
                <div class="text-blue-300 text-sm"><a href="{{$user->profile->url}}">{{$user->profile->url}}</a></div>
            </div>
        </div>
        <div class="row pt-5">
            @foreach($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{$post->id}}">
                        <img src="/storage/{{$post->image}}" alt="image" class="w-100">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
