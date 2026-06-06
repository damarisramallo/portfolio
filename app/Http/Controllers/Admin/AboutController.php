<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function edit()
    {
        return Inertia::render('Admin/About/Edit', [
            'about' => About::first(),
        ]);
    }

    public function update(Request $request)
    {
        $about = About::first();

        $data = $request->validate([
            'name'  => 'required|string|max:100',
            'bio'   => 'required|string|max:1000',
            'photo' => 'nullable|image',
            'cv'    => 'nullable|mimes:pdf|max:5120',
            'stack' => 'nullable|array',
        ]);

        if ($request->hasFile('photo')){
            if ($about->photo) {
                Storage::delete($about->photo);
            }

            $data['photo'] = Storage::put('about', $request->file('photo'));
        }

        if ($request->hasFile('cv')) {
            if ($about->cv) {
                Storage::delete($about->cv);
            }
            $data['cv'] = Storage::putFileAs('cv', $request->file('cv'), $request->file('cv')->getClientOriginalName());
        }

        if (!$request->hasFile('photo')) unset($data['photo']);
        if (!$request->hasFile('cv')) unset($data['cv']);
       

        $about->update($data);

        return redirect()->route('admin.about.edit')
            ->with('success', 'Perfil actualizado correctamente.');
    }
}
