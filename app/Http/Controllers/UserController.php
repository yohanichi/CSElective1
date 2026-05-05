<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::with(['createdBy', 'updatedBy'])->orderBy('username')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required|string|regex:/^[a-zA-Z0-9_]{3,20}$/|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'account_type' => 'required|in:admin,staff,teacher,student',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'account_type' => $request->account_type,
            'created_on' => now(),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|regex:/^[a-zA-Z0-9_]{3,20}$/|unique:users,username,' . $id,
            'account_type' => 'required|in:admin,admin-staff,teacher,student',
        ]);

        $user->update([
            'username' => $request->username,
            'account_type' => $request->account_type,
            'updated_on' => now(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting self
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully!');
    }
}
