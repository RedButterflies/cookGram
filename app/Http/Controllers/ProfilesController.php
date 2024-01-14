<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {

        $postCount=Cache::remember(
            'count.posts.'.$user->id,
            now()->addSeconds(30),
            function () use($user){
            return $user->posts->count();
        });

        $followersCount = Cache::remember(
            'count.followers.'.$user->id,
            now()->addSeconds(30),
            function () use($user){
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
                'count.following.'.$user->id,
                now()->addSeconds(30),
                function () use($user){
                    return $user->following->count();
                });
        //dd($userModel);
        $follows=(auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        //dd($follows);

        return view('profiles.index', compact('user','follows','postCount','followersCount','followingCount'));

    }
    public function edit(User $user)
    {
        $this->authorize('update',$user->profile);
        return view('profiles.edit',compact('user'));
    }

    public function deleteConfirmation(User $user)
    {
        $this->authorize('delete', $user->profile);

        return view('profiles.delete', compact('user'));
    }
    public function delete(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);


        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->withSuccess('Your account has been deleted.');
    }

    public function update(User $user)
    {

        $this->authorize('update',$user->profile);
       $data = request()->validate([
           'title'=> 'required',
           'description'=>'required',
           'url'=>'url',
           'image'=>'',
       ]);

       if(request('image'))
       {
           $imagePath = request('image')->store('profile', 'public');

           $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
           $image->save();
           $imageArray =  ['image' => $imagePath];
       }


        auth()->user()->profile->update(array_merge(
            $data,
           $imageArray ?? []
        ));
        return redirect("/profile/" . auth()->user()->id);


    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('username', 'like', '%' . $query . '%')->get();

        return view('profiles.search', compact('users'));
    }
}
