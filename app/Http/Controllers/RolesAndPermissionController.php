<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class RolesAndPermissionController extends Controller
{
    public function addPermissions(Request $request)
    {
        $permissions = ['View Evaluation', 'Apply Evaluation', 'Dashboard', 'Users', 'Calendar & Tools', 'Vacancies', 'New Joiners', 'Trasnfers/Rotation', 'Promotions', 'Badge Maker', 'Employees', 'Branches', 'Titles', 'Settings', 'Edit', 'Download', 'Create', 'Delete', 'Role And Permission', 'HR Member', 'Sundays','Target Controller'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }

    public function index()
    {
        $roles = Role::with('permissions')->get(); // Eager load permissions

        return view('RolesAndPermissions.index', compact('roles'));
    }

    public function create(Request $request)
    {
        $permissions = Permission::all();

        return view('RolesAndPermissions.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required|array',
        ]);

        // Create role
        $role = \Spatie\Permission\Models\Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        // Assign permissions properly
        $permissions = \Spatie\Permission\Models\Permission::whereIn('name', $request->permission)->get();

        if ($permissions->isEmpty()) {
            Log::error("No permissions found for role '{$role->name}'!");
        } else {
            $role->syncPermissions($permissions);
            Log::info("Role '{$role->name}' successfully assigned permissions.");
        }

        return redirect()->route('roles.index')->with('success', 'Role added successfully.');
    }

    public function edit($id)
    {
        // Force eager loading of permissions
        $role = \Spatie\Permission\Models\Role::with('permissions')->findOrFail($id);

        // Fetch all permissions
        $permissions = \Spatie\Permission\Models\Permission::all();

        // Ensure permissions are formatted properly
        $rolePermissions = $role->permissions->pluck('name')->toArray(); // ✅ Ensure array format

        return view('RolesAndPermissions.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permission' => 'required|array',
        ]);

        // Find role
        $role = \Spatie\Permission\Models\Role::findOrFail($id);

        // Update role name
        $role->update(['name' => $request->name]);

        // Assign permissions
        $permissions = \Spatie\Permission\Models\Permission::whereIn('name', $request->permission)->get();

        if ($permissions->isEmpty()) {
            Log::error("No permissions found for role '{$role->name}' during update!");
        } else {
            $role->syncPermissions($permissions);
            Log::info("Role '{$role->name}' updated with permissions.");
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        // Find the role by ID and delete it
        $role = Role::findOrFail($id);

        // You can also add checks here, for example, if the role has associated users or permissions
        $role->delete();

        // Redirect back with a success message
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    public function getRoles()
    {
        // Force eager loading to avoid missing permissions
        $roles = \Spatie\Permission\Models\Role::with('permissions')->get();

        // Transform roles to ensure correct structure
        $formattedRoles = $roles->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions->pluck('name')->toArray(), // ✅ Ensure correct format
            ];
        });

        return response()->json($formattedRoles);
    }

    public function assignRoleToUser(Request $request, $userId)
    {
        // Fetch the user by ID
        $user = User::findOrFail($userId);

        // Fetch the role by name
        $role = Role::findByName($request->role_name);

        // Assign the role to the user
        $user->assignRole($role);

        return back()->with('success', 'Role assigned successfully!');
    }
}
