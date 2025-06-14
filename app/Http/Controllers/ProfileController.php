<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

    // Validasi tambahan untuk foto
    $request->validate([
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Cek jika ada file yang diupload
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($user->foto && File::exists(public_path('img/' . $user->foto))) {
            File::delete(public_path('img/' . $user->foto));
        }

        // Simpan file baru
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('img'), $filename);
        $user->foto = $filename;
    }

    // Update data umum (nama, email, dll)
    $user->fill($request->validated());

    // Jika email berubah, reset verifikasi
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    // 🔥 Hapus foto jika ada
    if ($user->foto && File::exists(public_path('img/' . $user->foto))) {
        File::delete(public_path('img/' . $user->foto));
    }

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
}




}
