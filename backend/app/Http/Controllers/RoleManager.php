<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleManager extends Controller
{
    public function permissionsIndex()
    {
        return Permission::all();
    }

    public function rolesIndex()
    {
        return Role::all();
    }

    public function assignRoleToUser(Request $request)
    {
        /** @var Role $role */
        /** @var User $user */
        list($role, $user) = $this->getRoleAndUser($request);

        $user->assignRole($role);

        return response()->json([
            "message" => $role->name . " Role successfully assigned to User!"
        ], 200);
    }

    public function unassignRoleToUser(Request $request, Role $role, User $user)
    {
        /** @var Role $role */
        /** @var User $user */
        list($role, $user) = $this->getRoleAndUser($request);

        $user->removeRole($role);

        return response()->json([
            "message" => $role->name . " Role successfully removed from User"
        ], 200);
    }

    private function getRoleAndUser(Request $request) {
        $role_id = $request->json()->get("role_id");
        $user_id = $request->json()->get("user_id");

        try {
            /** @var Role $role */
            $role = Role::findById($role_id);
        } catch (RoleDoesNotExist $roleDoesNotExist) {
            return response()->json([
                "message" => "Role not found"
            ], 404);
        }

        /** @var User $user */
        $user = User::where('id', $user_id)->first();

        if (is_null($user)) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }

        return [$role, $user];
    }
}
