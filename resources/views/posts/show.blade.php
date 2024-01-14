@extends('layouts.app')

@section('content')
    <div style="background-color: white; border: #f4d9b9 10px dashed;" class="container pt-3 pb-3">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <img src="/storage/{{$post->image}}" alt="image" class="w-100">
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="flex align-items-center pb-3 pt-3">
                    <a href="/profile/{{$post->user->id}}">
                        <img src="/storage/{{$post->user->profile->image}}" alt="profileimage" style="max-height: 50px; max-width: 50px" class="rounded-full flex">
                    </a>
                    <div id="app" class="text-lg pl-3 font-bold flex align-items-baseline">
                        <a class="flex" href="/profile/{{$post->user->id}}">{{$post->user->username}}</a>
                        @if(auth()->user() && auth()->user()->id !== $post->user->id)
                            <follow-button user-id="{{$post->user->id}}" follows="{{$follows}}"></follow-button>
                            <div class="post-likes flex">
                                <form action="{{ route('posts.toggle-like', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $post->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-500' }}">
                                        <i class="fas fa-heart"></i>
                                        {{ $post->likes->count() }}
                                    </button>
                                </form>
                            </div>
                        @endif
                        @if(auth()->user() && auth()->user()->id == $post->user->id)
                            <div class="pt-3 text-sm text-red-500 pl-4 flex">
                                <a href="#" onclick="confirmDelete()">Delete Post</a>
                            </div>
                        @endif
                    </div>
                </div>
                <hr>
                @if(auth()->user() && auth()->user()->id == $post->user->id)
                    <div class="text-sm pt-3 flex pb-3">
                        {{ $post->likes->count() }} Likes
                    </div>
                @endif
                <hr>
                <p class="text-sm pt-3 flex align-items-baseline pb-3">
                    <span>
                        <a class="font-bold" href="/profile/{{$post->user->id}}">{{$post->user->username}}</a>
                        {{$post->caption}}
                        @if(auth()->user() && auth()->user()->id == $post->user->id)
                            <a class="text-xs text-blue-300" href="/p/{{$post->id}}/edit">Edit Caption</a>
                        @endif
                    </span>
                </p>
                <hr>
                <div class="text-sm text-blue-300 pt-3 flex">Comments:</div>
                <div class="text-sm flex">
                    @if($post->comments->count() > 0)
                        <div class="row">
                            @foreach($post->comments as $comment)
                                <div class="col-12">
                                    <div class="flex items-center">
                                        @if(isset($comment->user->profile->image))
                                            <a href="/profile/{{$comment->user->id}}">
                                                <img src="/storage/{{$comment->user->profile->image}}" alt="profileimage" style="max-height: 20px; max-width: 20px" class="rounded-full">
                                            </a>
                                        @endif
                                        <h3 class="pl-3 pr-4 pt-3 pb-3">
                                            <a class="font-bold " href="/profile/{{$comment->user->id}}">{{$comment->user->username}}</a>
                                            : {{ $comment->content }}
                                        </h3>
                                        @if(auth()->user() && auth()->user()->id === $comment->user_id)
                                            <div class="text-xs text-blue-300 pr-4">
                                                <a href="{{ route('comments.edit', $comment) }}">Edit</a>
                                            </div>
                                        @endif
                                        @if(auth()->user() && auth()->user()->id === $comment->user_id)
                                            <form id="delete-comment-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-xs text-red-500" type="button" onclick="confirmDeleteComment({{ $comment->id }})">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No comments.</p>
                    @endif
                </div>

                <div class="text-sm pt-3 flex">
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="flex items-center">
                            <textarea name="content" placeholder="Your comment" class="form-control" style="resize: none; border: 3px dashed #f1cda3; border-radius: 4px; padding: 8px; width: 100%; margin-right: 8px;" maxlength="255"></textarea>
                            <button class="btn btn-sm" style="border: 3px solid #f1cda3; background-color: cornflowerblue; color: white;" type="submit">Add comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this post?')) {
                window.location.href = '/p/{{$post->id}}/delete';
            }
        }

        function confirmDeleteComment(commentId) {
            if (confirm('Are you sure you want to delete this comment?')) {
                // If the user confirms, submit the form for comment deletion
                document.getElementById('delete-comment-form-' + commentId).submit();
            }
        }
    </script>
@endsection
