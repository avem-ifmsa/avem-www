<?php

namespace Avem\Console\Commands;

use Avem\Role;
use Avem\Permission;
use Illuminate\Console\Command;

class InitCommand extends Command
{
	const PERMISSIONS = [

		// Activity permissions
		['name' => 'activity:create', 'description' => 'Crear nuevas actividades'],
		['name' => 'activity:view'  , 'description' => 'Ver actividades creadas por otros'],
		['name' => 'activity:update', 'description' => 'Modificar actividades creadas por otros'],
		['name' => 'activity:delete', 'description' => 'Eliminar actividades creadas por otros'],

		// Charge permissions
		['name' => 'charge:create', 'description' => 'Crear nuevos cargos de junta'],
		['name' => 'charge:view'  , 'description' => 'Ver información sobre los cargos de junta'],
		['name' => 'charge:update', 'description' => 'Modificar información sobre los cargos de junta'],
		['name' => 'charge:delete', 'description' => 'Eliminar cargos de junta'],

		// Exchange permissions
		['name' => 'exchange:create', 'description' => 'Crear nuevos intercambios'],
		['name' => 'exchange:view'  , 'description' => 'Ver información sobre los intercambios existentes'],
		['name' => 'exchange:update', 'description' => 'Modificar información sobre los intercambios'],
		['name' => 'exchange:delete', 'description' => 'Eliminar intercambios'],

		// MbMember permissions
		['name' => 'mb-member:create', 'description' => 'Dar de alta miembros de junta'],
		['name' => 'mb-member:view'  , 'description' => 'Ver información sobre los miembros de junta'],
		['name' => 'mb-member:update', 'description' => 'Modificar la información de los miembros de junta'],
		['name' => 'mb-member:renew' , 'description' => 'Renovar los cargos de junta'],
		['name' => 'mb-member:delete', 'description' => 'Eliminar miembros de junta'],

		// User permissions
		['name' => 'user:create', 'description' => 'Crear nuevos socios'],
		['name' => 'user:view'  , 'description' => 'Ver la información de los socios'],
		['name' => 'user:update', 'description' => 'Modificar la información de los socios'],
		['name' => 'user:renew' , 'description' => 'Renovar a los socios'],
		['name' => 'user:delete', 'description' => 'Eliminar socios'],

		// WorkingGroup permissions
		['name' => 'working-group:create', 'description' => 'Crear nuevos grupos de trabajo'],
		['name' => 'working-group:view'  , 'description' => 'Ver información sobre los grupos de trabajo'],
		['name' => 'working-group:update', 'description' => 'Modificar la información de los grupos de trabajo'],
		['name' => 'working-group:delete', 'description' => 'Eliminar grupos de trabajo'],

	];

	const ROLES = [

		'admin_r' => [
			'description' => 'Administrador',
			'permissions' => [
				'activity:create', 'activity:view', 'activity:update', 'activity:delete',
				'charge:create', 'charge:view', 'charge:update', 'charge:delete',
				'exchange:create', 'exchange:view', 'exchange:update', 'exchange:delete',
				'mb-member:create', 'mb-member:view', 'mb-member:renew', 'mb-member:update', 'mb-member:delete',
				'user:create', 'user:view', 'user:renew', 'user:update', 'user:delete',
				'working-group:create', 'working-group:view', 'working-group:update', 'working-group:delete',
			],
		],

		'finances_r' => [
			'description' => 'Tesorería',
			'permissions' => [
				'user:view', 'user:renew',
			],
		],

		'activities_r' => [
			'description' => 'Cargos temático',
			'permissions' => [
				'activity:create',
			],
		],

		'bureaucracy_r' => [
			'description' => 'Cargos administrativos',
			'permissions' => [
				'charge:create', 'charge:view', 'charge:update', 'charge:delete',
				'mb-member:create', 'mb-member:view', 'mb-member:renew', 'mb-member:update', 'mb-member:delete',
				'working-group:create', 'working-group:view', 'working-group:update', 'working-group:delete',
			],
		],

		'exchanges_r' => [
			'description' => 'Intercambios',
			'permissions' => [
				'exchange:create', 'exchange:view', 'exchange:update', 'exchange:delete',
			],
		],

		'help_r' => [
			'description' => 'Asistencia a socios',
			'permissions' => [
				'activity:view',
				'user:view', 'user:update',
			],
		],

	];

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'avem:init';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Initializes the AVEM database';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	private function initPermissions()
	{
		Permission::insert(static::PERMISSIONS);
	}

	private function initRoles()
	{
		foreach (static::ROLES as $name => $info) {
			$role = Role::firstOrCreate([ 'name' => $name ], $info);
			$role->permissions()->saveMany(
				Permission::whereIn('name', $info['permissions'])->get()
			);
		}
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->initPermissions();
		$this->initRoles();
	}
}
