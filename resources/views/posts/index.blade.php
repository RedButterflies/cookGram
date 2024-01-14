@extends('layouts.app')

@section('content')
    <div style="border: #fef3c7 10px dashed; background-color: white;" class="container pb-3">

        @foreach($posts as $post)
            <div style="background-color: white;" class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 offset-md-3">
                    <a href="/profile/{{$post->user->id}}">
                        <img src="/storage/{{$post->image}}" alt="image" class="w-100">
                    </a>
                </div>
            </div>

            <div class="row pt-2 pb-6">
                <div class="col-lg-8 col-md-12 col-sm-12 offset-md-2">
                    <div class="text-sm">
                        <div class="flex align-items-center pb-1">
                            <a href="/profile/{{$post->user->id}}">
                                <img src="/storage/{{$post->user->profile->image}}" alt="profileimage" style="max-height: 40px; max-width: 40px" class="rounded-full">
                            </a>
                            <h3 class="pl-3 pr-4 font-bold">
                                <a href="/profile/{{$post->user->id}}">{{$post->user->username}}</a>
                            </h3>
                        </div>

                        <div class="pb-6 pl-12">
                            {{$post->caption}}
                            <div class="post-likes">
                                <form action="{{ route('posts.toggle-like', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $post->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-500' }}">
                                        <i class="fa-solid fa-handshake"></i>
                                        Likes {{ $post->likes->count() }}
                                    </button>
                                </form>
                            </div>
                            <div class="pb-6 pl-3" style="color: deepskyblue">
                                <i class="fa-solid fa-comment"></i>
                                <a href="{{ route('posts.show', $post) }}">{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}</a>
                            </div>
                            <div class="text-sm pt-3 pb-3 flex justify-content-center">
                                <form method="post" action="{{ route('comments.store') }}">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="flex items-center">
                                        <textarea name="content" placeholder="Your comment" class="form-control" style="background-color: aliceblue; resize: none; border: 3px dashed #f1cda3; border-radius: 4px; padding: 8px; width: 100%; margin-right: 8px;" maxlength="255"></textarea>
                                        <button class="btn btn-sm" style="border: 3px solid #f1cda3; background-color: cornflowerblue; color: white;" type="submit">Add comment</button>
                                    </div>
                                </form>
                            </div>

                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="col-12 flex justify-content-center">
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection
