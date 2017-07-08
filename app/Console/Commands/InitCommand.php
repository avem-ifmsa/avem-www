<?php

namespace Avem\Console\Commands;

use DB;
use Avem\Role;
use Avem\Permission;
use Avem\WorkingGroup;
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
		['name' => 'charge:renew' , 'description' => 'Modificar la pertenencia de los usuarios a los distintos cargos de junta'],
		['name' => 'charge:update', 'description' => 'Modificar información sobre los cargos de junta'],
		['name' => 'charge:delete', 'description' => 'Eliminar cargos de junta'],

		// Exchange permissions
		['name' => 'exchange:create', 'description' => 'Crear nuevos intercambios'],
		['name' => 'exchange:view'  , 'description' => 'Ver información sobre los intercambios existentes'],
		['name' => 'exchange:update', 'description' => 'Modificar información sobre los intercambios'],
		['name' => 'exchange:delete', 'description' => 'Eliminar intercambios'],

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
				'charge:create', 'charge:view', 'charge:update', 'charge:renew', 'charge:delete',
				'exchange:create', 'exchange:view', 'exchange:update', 'exchange:delete',
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
				'charge:create', 'charge:view', 'charge:update', 'charge:renew', 'charge:delete',
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

	const WORKING_GROUPS = [

		'Cargos burocráticos' => [
			'color' => '#a01238',
			
		],

		'Grupos de trabajo temático' => [

		],

		'Cargos de apoyo' => [
			'color' => '#c8c800',

		],

		'Cargos de intercambios' => [
			'color' => '#1368d8',

		],

		'Educación médica' => [
			'color'  => '#485b6b',
			'parent' => 'Grupos de trabajo temático',

		],

		'Salud pública' => [
			'color'  => '#ff8316',
			'parent' => 'Grupos de trabajo temático',

		],

		'Sexualidad' => [
			'color'  => '#dc083c',
			'parent' => 'Grupos de trabajo temático',

		],

		'Derechos humanos' => [
			'color'  => '#44b724',
			'parent' => 'Grupos de trabajo temático',

		],

		'Intercambios internacionales clínicos' => [
			'parent' => 'Cargos de intercambios',

		],

		'Intercambios internacionales de investigación' => [
			'parent' => 'Cargos de intercambios',

		],

		'Intercambios nacionales' => [
			'parent' => 'Cargos de intercambios',

		],

		'Coordinación de acogida de intercambios' => [
			'parent' => 'Cargos de intercambios',

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

	private function initWorkingGroups()
	{
		foreach (static::WORKING_GROUPS as $name => $info) {
			$workingGroup = WorkingGroup::firstOrCreate([ 'name' => $name ], $info);
			if (isset($info['parent'])) {
				$parentName = $info['parent'];
				$parentInfo = static::WORKING_GROUPS[$parentName];
				$parent = WorkingGroup::firstOrCreate([ 'name' => $parentName ], $parentInfo);
				$workingGroup->parent()->associate($parent->id);
				$workingGroup->save();
			}
		}
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		DB::transaction(function() {
			$this->initPermissions();
			$this->initRoles();

			$this->initWorkingGroups();
		});

		$this->info('Database initialized');
	}
}
