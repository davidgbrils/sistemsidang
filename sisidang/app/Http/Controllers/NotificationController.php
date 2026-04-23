<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $notifications = $user->notifications()->orderBy('created_at', 'desc')->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(string $id): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }

    public function markAllAsRead(): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'Semua notifikasi telah dibaca');
    }

    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->delete();
        }

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus');
    }

    public function clearAll(): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $user->notifications()->delete();

        return redirect()->back()->with('success', 'Semua notifikasi berhasil dihapus');
    }
}
