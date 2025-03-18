<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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
            'status' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'role_name' => 'required|string', // Ensure the role is validated
        ]);

        // Create user
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->status = $validated['status'];

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('user-images', 'public');
            $user->image = $path;
        }

        $user->save();

        $role = Role::where('name', $validated['role_name'])->first();

        if ($role) {
            // Insert manually into `model_has_roles`
            DB::table('model_has_roles')->insert([
                'role_id' => $role->id,
                'model_id' => $user->id,
                'model_type' => User::class, // Manually set model_type
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        // Fetch all roles
        $roles = DB::table('roles')->get();

        // Fetch the assigned role for the user
        $userRole = $user->roles->pluck('name')->first(); // Get first assigned role

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'status' => 'required|string',
            'role_name' => 'required|string', // Ensure role_name is validated
        ]);

        $user = User::findOrFail($id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->status = $validated['status'];

        // Update password only if provided
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        // Handle image upload if any
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

        $role = Role::where('name', $validated['role_name'])->first();

        if ($role) {
            // First, delete the existing roles for this user
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();

            // Insert the new role manually
            DB::table('model_has_roles')->insert([
                'role_id' => $role->id,
                'model_id' => $user->id,
                'model_type' => User::class, // Manually set model_type
            ]);
        }

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

        $users = User::with('roles') // Load roles
            ->when($role !== 'all', function ($query) use ($role) {
                $query->role($role); // Filter users by role
            })
            ->get(['id', 'name', 'email', 'created_at', 'status', 'image']); // Fetch required columns

        // Format response to include role names
        $formattedUsers = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'status' => $user->status,
                'image' => $user->image,
                'role_name' => $user->roles->pluck('name')->implode(', '), // Get role names
            ];
        });

        return response()->json($formattedUsers);
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

        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'User not authenticated.'], 401);
            }

            DB::table('users')->where('id', Auth::id())->update([
                'temp_pass' => Hash::make($request->temp_pass)
            ]);


            return response()->json(['message' => 'Password successfully saved.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to save the password: ' . $e->getMessage()], 500);
        }
    }

    public function checkTempPass()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'temp_pass' => $user->temp_pass,
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
