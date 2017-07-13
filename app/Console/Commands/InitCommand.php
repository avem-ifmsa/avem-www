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
			'color'         => '#485b6b',
			'parent'        => 'Grupos de trabajo temático',
			'ifmsa_name'    => 'Standing Committee On Medical Education',
			'ifmsa_acronym' => 'SCOME',
			'description'   =>
				'Se encarga de la formación médica complementaria, ampliándola mediante '  .
				'charlas, cursillos y otras actividades. Además, trabaja el estado de la ' .
				'educación médica y la docencia.',
		],

		'Salud pública' => [
			'color'         => '#ff8316',
			'parent'        => 'Grupos de trabajo temático',
			'ifmsa_name'    => 'Standing Committee On Public Health',
			'ifmsa_acronym' => 'SCOPH',
			'description'   =>
				'Organiza actividades para informar sobre cómo prevenir enfermedades, ' .
				'mantener un estado de salud adecuado y acercar la medicina al ámbito ' .
				'público. Entre sus actividades estrella se encuentra la famosa Feria ' .
				'de la Salud por el Día Mundial de la Salud (DMS).',
		],

		'Sexualidad' => [
			'color'         => '#dc083c',
			'parent'        => 'Grupos de trabajo temático',
			'ifmsa_name'    => 'Standing Committee On Reproductive health and Sexuality including HIV/AIDS',
			'ifmsa_acronym' => 'SCORSA',
			'description'   =>
				'Organizan charlas, debates, videofórums y otras actividades para ' .
				'informar y formar sobre temas de salud reproductiva y sexualidad.',
		],

		'Derechos humanos' => [
			'color'         => '#44b724',
			'parent'        => 'Grupos de trabajo temático',
			'ifmsa_name'    => 'Standing Committee On Human Rights and Peace',
			'ifmsa_acronym' => 'SCORP',
			'description'   =>
				'Organiza actividades relacionadas con la paz, los refugiados y los derechos' .
				'humanos, poniendo énfasis en la concienciación sobre desigualdad, '          .
				'intolerancia, racismo, violencia y abuso a las personas.',
		],

		'Intercambios internacionales clínicos' => [
			'parent'        => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On Professional Exchanges',
			'ifmsa_acronym' => 'SCOPE',
			'description'   =>
				'Gestionan los intercambios clínicos entre universidades de todo el mundo. Los ' .
				'intercambios clínicos solo están disponibles para socios a partir de 3º curso.',
		],

		'Intercambios internacionales de investigación' => [
			'parent'        => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On Research Exchanges',
			'ifmsa_acronym' => 'SCORE',
			'description'   =>
				'Gestiona intercambios ligados a proyectos de investigación internacional '      .
				'entre universidades de todo el mundo. Los intercambios de investigación están ' .
				'disponibles para estudiantes de todos los cursos.',
		],

		'Intercambios nacionales' => [
			'parent'        => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On National Exchanges',
			'ifmsa_acronym' => 'SCONE',
			'description'   =>
				'Gestionan los intercambios entre universidades españolas, tanto para los que ' .
				'vienen (incomings) como para los que se van (outgoings). Coordinan tanto '     .
				'intercambios clínicos (o profesionales) como de investigación.',
		],

		'Coordinación de acogida de intercambios' => [
			'parent'        => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On Incoming Hosting',
			'ifmsa_acronym' => 'SCOIH',
			'description'   =>
				'Ajusta el programa de intercambios al presupuesto pautado por tesorería, ' .
				'gestiona el programa acoge un guiri, coordina la acogida de incomings '    .
				'(condiciones, distribución y otras características del alojamiento) y es ' .
				'responsable de los Contact Person.',
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
				$workingGroup->parentGroup()->associate($parent->id);
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
