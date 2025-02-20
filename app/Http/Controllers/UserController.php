<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = DB::table('roles')->get(); // Fetch roles from `roles` table
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role_name' => 'required|string',
            'status' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validate image file
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->role_name = $validated['role_name'];
        $user->status = $validated['status'];

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('user-images', 'public'); // Save in storage/app/public/user-images
            $user->image = $path; // Save the relative path in the database
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        $roles = DB::table('roles')->get();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8', // Nullable means it can be left blank
            'role_name' => 'required|string',
            'status' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validate image file
        ]);

        $user = User::findOrFail($id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_name = $validated['role_name'];
        $user->status = $validated['status'];

        // Update password only if provided
        if (!empty($validated['password'])) { // Check if password is provided
            $user->password = bcrypt($validated['password']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }

            // Save the new image
            $path = $request->file('image')->store('user-images', 'public');
            $user->image = $path;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }


    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function getUsersByRole(Request $request)
    {
        $role = $request->query('role', 'all'); // Default to 'all'

        // Query users based on the 'role_name' column
        $users = User::query()
            ->when($role !== 'all', function ($query) use ($role) {
                $query->where('role_name', ucfirst(str_replace('-', ' ', $role))); // Match 'HR Manager', 'HR Supervisor', etc.
            })
            ->get(['id', 'name', 'email', 'created_at', 'status', 'image', 'role_name']);

        return response()->json($users);
    }

    public function profile()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }

    public function lockRule(Request $request)
    {
        $request->validate([
            'temp_pass' => 'required|string|max:10',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        $user->temp_pass = Hash::make($request->temp_pass); // Save or update hashed password
        $user->save();

        return response()->json(['message' => 'Password successfully saved.']);
    }

    public function checkTempPass()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'temp_pass' => $user->temp_pass
            ]);
        }

        return response()->json(['error' => 'User not authenticated.'], 401);
    }

    public function lockScreen()
    {
        $user = Auth::user();
        return view('users.lock', compact('user')); // Show the lock screen
    }

    public function unlockScreen(Request $request)
    {
        $request->validate([
            'temp_pass' => 'required|string|max:10',
        ]);

        $user = Auth::user();

        // Check if the temp_pass matches the stored hash
        if (!$user || !Hash::check($request->temp_pass, $user->temp_pass)) {
            return redirect()
                ->back()
                ->withErrors(['temp_pass' => 'Incorrect password. Please try again.']);
        }

        // Redirect to the profile page
        return redirect()->route('users.profile')->with('success', 'Welcome back! We Missed You ❤️');
    }

}
