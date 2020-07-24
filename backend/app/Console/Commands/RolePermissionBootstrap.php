<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionBootstrap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twice:bootstrap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create roles and permissions for twice demo app';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $roles = ["Admin", "User","Artist"];

        $permissions = [
            "View All Users", 
            "Edit All Users", 
            "Assign Role", 
            "Unassign Role", 
            "View All Permissions",
            "View All Roles"];


        $this->line('------------- Setting Up Roles:');

        foreach ($roles as $role) {
            $role = Role::updateOrCreate(['name' => $role, 'guard_name' => 'api']);
            $this->info("Created " . $role->name . " Role");
        }

        $this->line('------------- Setting Up Permissions:');

        $adminRole = Role::where('name', "Admin")->first();

        foreach ($permissions as $perm_name) {
            $permission = Permission::updateOrCreate(['name' => $perm_name,
                'guard_name' => 'api']);

            $adminRole->givePermissionTo($permission);

            $this->info("Created " . $permission->name . " Permission");
        }

        $this->info("All permissions are granted to Admin");
        $this->line('------------- Application Bootstrapping is Complete: \n');
    }
}
