<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Repositories\UploadRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function show($profile)
    {
        $user    = User::where('username', $profile)->first();
        $profile = Profile::find($user->id);

        return view('users.profile', ['user' => $user, 'profile' => $profile]);
    }


    public function editingInfo($username)
    {
        //@todo add role check
        if (Auth::user()->username == $username) {
            $profile = Profile::where('user_id', Auth::user()->id)->first();

            return view('users/settings/info', ['user' => Auth::user(), 'profile' => $profile]);
        } else {
            return redirect()->route('showProfile', ['id' => $username]);
        }
    }

    public function updateInfo($username, Request $request)
    {

        $this->validate($request, [
            'description' => 'required|string|max:50'
        ]);


        $profile = Profile::where('user_id', Auth::user()->id)->first();

        $profile->description = $request->input('description');
        $profile->save();

        return back()->with('success', 'Info updated');
    }


    public function editingAvatar($username)
    {
        //@todo add role check
        if (Auth::user()->username == $username) {
            $profile = Profile::where('user_id', Auth::user()->id)->first();

            return view('users/settings/avatar', ['user' => Auth::user(), 'profile' => $profile]);
        } else {
            return redirect()->route('showProfile', ['id' => $username]);
        }
    }

    public function updateAvatar($username, Request $request, UploadRepository $uploadRepository)
    {

        $this->validate($request, [
            'new_avatar' => 'mimes:jpeg,jpg,png|required|dimensions:max_width=500,max_height=500|max:5120'
        ]);

        $uploadedImage = $uploadRepository->upload_image($request->new_avatar, '\users\avatars');
        
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $uploadRepository->delete_old_image($profile->avatar, '\users\avatars');

        $profile->avatar = $uploadedImage;
        $profile->save();

        return back()->with('success', 'Avatar updated');
    }


    public function editingCover($username)
    {
        //@todo add role check
        if (Auth::user()->username == $username) {
            $profile = Profile::where('user_id', Auth::user()->id)->first();

            return view('users/settings/cover', ['user' => Auth::user(), 'profile' => $profile]);
        } else {
            return redirect()->route('showProfile', ['id' => $username]);
        }
    }

    public function updateCover($username, Request $request, UploadRepository $uploadRepository)
    {
        $this->validate($request, [
            'new_cover' => 'mimes:jpeg,jpg,png|required|dimensions:max_width=3000,max_height=900|max:10240'
        ]);

        $uploadedImage = $uploadRepository->upload_image($request->new_cover, '\users\covers');

        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $uploadRepository->delete_old_image($profile->profile_cover, '\users\covers');

        $profile->profile_cover = $uploadedImage;
        $profile->save();

        return back()->with('success', 'Cover updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
