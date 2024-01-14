<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentsController extends Controller
{
    /**
     * Dodawanie nowego komentarza.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {

        $request->validate([
            'content' => 'required|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);


        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);


        return redirect()->back();
    }

    /**
     * Usuwanie komentarza.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect("/p/".$comment->post->id);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect("/p/".$comment->post->id);
    }
    public function __construct()
    {
        $this->middleware('auth');

    }
}
