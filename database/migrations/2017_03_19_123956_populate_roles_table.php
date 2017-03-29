<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateRolesTable extends Migration
{
	const ROLES = [
		['name' => 'admin_r'      , 'description' => 'Administración'        ],
		['name' => 'finances_r'   , 'description' => 'Cargos económicos'     ],
		['name' => 'activities_r' , 'description' => 'Cargos temáticos'      ],
		['name' => 'bureaucracy_r', 'description' => 'Cargos administrativos'],
		['name' => 'exchanges_r'  , 'description' => 'Cargos de intercambios'],
		['name' => 'help_r'       , 'description' => 'Asistencia a socios'   ],
	];

	const PERMISSIONS = [
		'admin_r' => [
			'activity:create', 'activity:view', 'activity:update', 'activity:delete',
			'charge:create', 'charge:view', 'charge:update', 'charge:delete',
			'exchange:create', 'exchange:view', 'exchange:update', 'exchange:delete',
			'mb-member:create', 'mb-member:view', 'mb-member:renew', 'mb-member:update', 'mb-member:delete',
			'user:create', 'user:view', 'user:renew', 'user:update', 'user:delete',
			'working-group:create', 'working-group:view', 'working-group:update', 'working-group:delete',
		],

		'finances_r' => [
			'user:view', 'user:renew',
		],

		'activities_r' => [
			'activity:create',
		],

		'bureaucracy_r' => [
			'charge:create', 'charge:view', 'charge:update', 'charge:delete',
			'mb-member:create', 'mb-member:view', 'mb-member:renew', 'mb-member:update', 'mb-member:delete',
			'working-group:create', 'working-group:view', 'working-group:update', 'working-group:delete',
		],

		'exchanges_r' => [
			'exchange:create', 'exchange:view', 'exchange:update', 'exchange:delete',
		],

		'help_r' => [
			'activity:view',
			'user:view', 'user:update',
		],
	];

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('roles')->insert(static::ROLES);
		$roleNames = array_column(static::ROLES, 'name');
		foreach ($roleNames as $roleName) {
			$permissionNames = static::PERMISSIONS[$roleName];
			$role = DB::table('roles')->where('name', $roleName)->first();
			$rolePermissions = DB::table('permissions')->whereIn('name', $permissionNames)->get();
			foreach ($rolePermissions as $permission) {
				DB::table('permission_role')->insert([
					'role_id' => $role->id, 'permission_id' => $permission->id
				]);
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$names = array_column(static::ROLES, 'name');
		DB::table('roles')->whereIn('name', $names)->delete();
	}
}
