<?php

namespace App\Http\Controllers;

use File;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{

    public function index()
    {
        return view('dashboard.profile.index', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request, User $user)
    {

        $old = $user->find(auth()->user()->id);

        if ($request->username !== $old->username)
            $validateUsername = 'required|min:2|max:255|unique:users|alpha_dash';
        else
            $validateUsername = 'required|min:2|max:255|alpha_dash';

        $validData = $request->validate([
            'name' => 'required|max:120',
            'username' => $validateUsername,
            // 'email' => 'required|email:dns',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',
        ]);

        unset($validData['oldPassword']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . "_" . $image->hashName();
            $image->storeAs('/images/profiles', $imageName, 'public');
            $validData['image'] = $imageName;
            // Storage::delete($old->image);
            // unlink('/storage/app/public/images/profiles/' . $old->image);
            // if (File::exists('storage/app/public/images/profiles/' . $old->image))
        }
        $user->where('id', auth()->user()->id)->update($validData);

        return redirect()->back();
    }

    public function updatePassword(Request $request, User $user)
    {
        $validData = $request->validate([
            'oldPassword' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->uncompromised()],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        $user = $user->find(auth()->user()->id);
        $user->password = bcrypt($request->password);
        if ($user->save())
            return redirect()->back()->with('alert', 'Your Password Has Been Changed.');
        else
            return redirect()->to('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}