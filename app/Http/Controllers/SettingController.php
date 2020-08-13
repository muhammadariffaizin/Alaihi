<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Rules\MatchOldPassword;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application setting.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        return view('admin.settings');
    }

    /**
     * Update the user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui');
    }

    /**
     * Update the user password.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update_password(Request $request)
    {
        $rules = [
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ];

        $message = [
            'same' => 'Sandi baru yang dimasukkan berbeda, mohon ulangi lagi.'
        ];
        $this->validate($request, $rules, $message);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect()->back()->with('success', 'Sandi Anda berhasil diperbarui');
    }
}
