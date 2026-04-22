<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Sync Spatie role
        $user->syncRoles([$request->role]);

        // Update the 'role' field in user table for consistency (as used in other parts of the app)
        $user->update(['role' => $request->role]);

        return back()->with('status', 'User role updated successfully.');
    }
}
