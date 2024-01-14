<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
//use Intervention\Image\Facades\Image;

use Intervention\Image\Facades\Image;
use Intervention\Image\Gd;
//use Intervention\Image\Image;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id',$users)->with('user')->latest()->paginate(5);
        return view('posts.index',compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,

        ]);
        return redirect('/profile/' . auth()->user()->id);
    }
    public function edit(Post $post)
    {
        return view ('posts.edit',compact('post'));
    }

    public function show(Post $post)
    {
        $follows=(auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;
        return view('posts.show',compact('post','follows'));
    }
        //dd(request()->all());

    public function update(Post $post)
    {
        $data = request()->validate([
            'caption'=>'required|max:255',

        ]);
        $post->update($data);
        return redirect("/p/".$post->id);


    }
    public function delete(Post $post)
    {
        $this->authorize('delete', $post); // Ensure the user is authorized to delete the post
        $post->delete();

        return redirect('/profile/' . auth()->user()->id);
    }
    public function toggleLike(Post $post)
    {
        $user = auth()->user();

        $existingLike = Like::where('user_id', $user->id)->where('post_id', $post->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            return redirect()->back()->with('message', 'Like removed!');
        } else {
            $like = new Like();
            $like->user_id = $user->id;
            $like->post_id = $post->id;
            $like->save();
            return redirect()->back()->with('message', 'Post liked!');
        }
    }


}
