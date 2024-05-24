<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;


class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth('admin')->user();
        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames(),
            'languages' => Languages::getNames(),
        ]);
    }

    public function update(Request $request)
    {
        $cleanData = $request->validate(Profile::rules());
        $user = $request->guard('admin')->user();
        $user->profile->fill($cleanData)->save();

        return redirect()->route('dashboard.profile.edit')->with('success', 'Profile updated!');
    }
}
