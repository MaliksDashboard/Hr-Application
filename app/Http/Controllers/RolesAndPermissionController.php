<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionController extends Controller
{
    public function addPermissions(Request $request)
    {
        $permissions = ['Dashboard', 'Users', 'Calendar & Tools', 'Vacancies', 'New Joiners', 'Trasnfers/Rotation', 'Promotions', 'Badge Maker', 'Employees', 'Branches', 'Titles', 'Settings','Edit','Download','Create'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }

    public function index()
    {
        $roles = Role::all();
        return view('RolesAndPermissions.index', compact('roles'));
    }

    public function create(Request $request)
    {
        $permissions = Permission::all();

        return view('RolesAndPermissions.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        $role = Role::create([
            'name' => 'Test',
            'guard_name' => 'web', // Ensure guard is explicitly set
        ]);
        
        foreach ($request->permission as $permission) {
            $role->givePermissionTo($permission);
        }
    
        return redirect('RolesAndPermissions.index');
    }

}
