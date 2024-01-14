@extends('layouts.app')

@section('content')
        <div style="background-color: white;border: #f1cda3 10px dashed" class="container flex justify-content-center pt-3 pb-3">
            <form method="post" action="{{ route('comments.update', $comment) }}">
                @csrf
                @method('put')

                <textarea name="content" class="form-control" style="resize: none; border: 1px solid #ccc; border-radius: 4px; padding: 8px; width: 100%; margin-right: 8px;" maxlength=255">{{ $comment->content }}</textarea>

                <button class="btn  mt-3" style="background-color: lightskyblue;color:white" type="submit">Update Comment</button>
            </form>
        </div>
@endsection
