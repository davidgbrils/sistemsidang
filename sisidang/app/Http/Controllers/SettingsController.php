<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index(): View
    {
        return view('settings.index');
    }

    public function updateTheme(Request $request): RedirectResponse
    {
        $theme = $request->validate([
            'theme' => 'required|in:light,dark,system',
        ]);

        session(['theme' => $theme['theme']]);

        return redirect()->back()->with('success', 'Tema berhasil diperbarui');
    }
}
