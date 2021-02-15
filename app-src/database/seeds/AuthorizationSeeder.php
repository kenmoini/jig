<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AuthorizationSeeder extends Seeder
{
    public $groups = [
        ['name' => 'Administrators', 'slug' => 'administrators', 'description' => 'Jig Administrators'],
        ['name' => 'Red Hatters - Basic', 'slug' => 'red-hatters-basic', 'description' => 'Primary user group for Red Hatters'],
        ['name' => 'Red Hatters - Proctor', 'slug' => 'red-hatters-proctor', 'description' => 'Red Hatters who can proctor workshop events'],
        ['name' => 'Red Hatters - Operator', 'slug' => 'red-hatters-operator', 'description' => 'Red Hatters who can operate Jig'],
    ];

    public $roles = [
        ['name' => 'Administrators', 'slug' => 'administrators', 'description' => 'Global Administrative capabilities'],
        ['name' => 'Limited Admin', 'slug' => 'limited-admin', 'description' => 'Limited administrative capabilities, less those that can touch the system and RBAC'],
        ['name' => 'Workshop Proctor', 'slug' => 'workshop-proctor', 'description' => 'Capabilities needed to operate as a Workshop Proctor'],
        ['name' => 'Basic', 'slug' => 'basic', 'description' => 'Basic capabilities, mostly just view'],
    ];

    public $capabilities = [
        ['key' => 'admin.general.view-index', 'description' => 'Can View the Administration > General page'],
        ['key' => 'admin.general.view-commands', 'description' => 'Can View the Administration > General > Commands page'],
        ['key' => 'admin.general.view-logs', 'description' => 'Can View the Administration > General > Logs page'],
        ['key' => 'admin.general.delete-logs', 'description' => 'Can Delete Log Files'],
        ['key' => 'admin.general.run-commands', 'description' => 'Can run Artisan Commands from the WebUI'],
        ['key' => 'admin.users.view', 'description' => 'Can view Jig Users'],
        ['key' => 'admin.users.edit', 'description' => 'Can add/edit Jig Users'],
        ['key' => 'admin.users.delete', 'description' => 'Can delete Jig Users'],
        ['key' => 'admin.groups.view', 'description' => 'Can view Jig Groups'],
        ['key' => 'admin.groups.edit', 'description' => 'Can add/edit Jig Groups'],
        ['key' => 'admin.groups.delete', 'description' => 'Can delete Jig Groups'],
        ['key' => 'admin.roles.view', 'description' => 'Can view Jig Roles'],
        ['key' => 'admin.roles.edit', 'description' => 'Can add/edit Jig Roles'],
        ['key' => 'admin.roles.delete', 'description' => 'Can delete Jig Roles'],
        ['key' => 'admin.capabilities.view', 'description' => 'Can view Jig Role Capabilites'],
        ['key' => 'panel.workshops.view', 'description' => 'Can view Workshops'],
        ['key' => 'panel.workshops.edit', 'description' => 'Can add/edit Workshops'],
        ['key' => 'panel.workshops.delete', 'description' => 'Can delete Workshops'],
        ['key' => 'panel.events.view', 'description' => 'Can view Events'],
        ['key' => 'panel.events.edit', 'description' => 'Can add/edit Events'],
        ['key' => 'panel.events.delete', 'description' => 'Can delete Events'],
        ['key' => 'panel.students.view', 'description' => 'Can view Students'],
        ['key' => 'panel.students.edit', 'description' => 'Can add/edit Students'],
        ['key' => 'panel.students.delete', 'description' => 'Can delete Students'],
        ['key' => 'panel.activity-reports.view', 'description' => 'Can view Activity Reports'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roll Groups
        if (Schema::hasTable('groups')) {
            foreach ($this->groups as $group) {
                $rowCheck = DB::table('groups')->where('slug', $group['slug'])->first();
                if (!$rowCheck) {
                    echo "[DB SEED] Inserting group '" . $group['name'] . "' ...\n";
                    DB::table('groups')->insert([
                        'name' => $group['name'],
                        'slug' => $group['slug'],
                        'description' => $group['description'],
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ]);
                }
            }
        }
        // Roll Roles
        if (Schema::hasTable('roles')) {
            foreach ($this->roles as $role) {
                $rowCheck = DB::table('roles')->where('slug', $role['slug'])->first();
                if (!$rowCheck) {
                    echo "[DB SEED] Inserting role '" . $role['name'] . "' ...\n";
                    DB::table('roles')->insert([
                        'name' => $role['name'],
                        'slug' => $role['slug'],
                        'description' => $role['description'],
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ]);
                }
            }
        }
        // Roll Capabilities
        if (Schema::hasTable('capabilities')) {
            foreach ($this->capabilities as $capability) {
                $rowCheck = DB::table('capabilities')->where('key', $capability['key'])->first();
                if (!$rowCheck) {
                    echo "[DB SEED] Inserting capability '" . $capability['key'] . "' ...\n";
                    DB::table('capabilities')->insert([
                        'key' => $capability['key'],
                        'description' => $capability['description'],
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ]);
                }
            }
        }

        // Cook Group + Role
        $groupRoles = [
            ['groupSlug' => 'administrators', 'roleSlug' => 'administrators'],
            ['groupSlug' => 'red-hatters-basic', 'roleSlug' => 'basic'],
            ['groupSlug' => 'red-hatters-operator', 'roleSlug' => 'limited-admin'],
            ['groupSlug' => 'red-hatters-proctor', 'roleSlug' => 'workshop-proctor'],
        ];
        foreach ($groupRoles as $groupRole) {
            $group = DB::table('groups')->where('slug', $groupRole['groupSlug'])->first();
            $role = DB::table('roles')->where('slug', $groupRole['roleSlug'])->first();

            $rowCheck = DB::table('group_role')->where('group_id', $group->id)->where('role_id', $role->id)->first();
            if (!$rowCheck) {
                echo "[DB SEED] Inserting Group/Role Mapping '" . $groupRole['groupSlug'] . ":" . $groupRole['roleSlug'] . "' ...\n";
                DB::table('group_role')->insert([
                    'group_id' => $group->id,
                    'role_id' => $role->id,
                ]);
            }
        }
        $allFlatCapabilities = $basicFlatCapabilites = [];
        foreach ($this->capabilities as $cap) {
            $allFlatCapabilities[] = $cap['key'];
        }
        $roleCapabilities = [
            ['roleSlug' => 'basic', 'capabilities' => [
                'admin.users.view',
                'admin.groups.view',
                'admin.roles.view',
                'panel.workshops.view',
                'panel.events.view',
                'panel.students.view',
                'panel.activity-reports.view'
            ]],
            ['roleSlug' => 'workshop-proctor', 'capabilities' => [
                'panel.events.edit',
                'panel.events.delete',
                'panel.students.edit',
                'panel.students.delete',
            ]],
            ['roleSlug' => 'limited-admin', 'capabilities' => [
                'admin.general.view-index',
                'admin.general.view-logs',
                'admin.general.view-commands',
                'admin.users.edit',
                'admin.users.delete',
                'admin.groups.edit',
                'admin.groups.delete',
                'admin.roles.edit',
                'admin.roles.delete',
                'admin.capabilities.view',
                'panel.workshops.edit',
                'panel.workshops.delete',
            ]],
            ['roleSlug' => 'administrators', 'capabilities' => $allFlatCapabilities],
        ];
        // Cook Role + Capabilties
        foreach ($roleCapabilities as $roleCapability) {
            $role = DB::table('roles')->where('slug', $roleCapability['roleSlug'])->first();
            foreach ($roleCapability['capabilities'] as $capSlug) {
                $capCheck = DB::table('capabilities')->where('key', $capSlug)->first();
                $capRoleCheck = DB::table('capability_role')->where('capability_id', $capCheck->id)->where('role_id', $role->id)->first();
                if (!$capRoleCheck) {
                    echo "[DB SEED] Inserting Role/Capability Mapping '" . $roleCapability['roleSlug'] . ":" . $capSlug . "' ...\n";
                    DB::table('capability_role')->insert([
                        'capability_id' => $capCheck->id,
                        'role_id' => $role->id,
                    ]);
                }
            }
        }
    }
}
