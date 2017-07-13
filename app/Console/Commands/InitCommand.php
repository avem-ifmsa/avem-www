<?php

namespace Avem\Console\Commands;

use DB;
use Avem\Tag;
use Avem\Role;
use Avem\Charge;
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
			'tags'          => ['SCOME', 'Educación médica'],
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
			'tags'          => ['SCOPH', 'Salud pública'],
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
			'tags'          => ['SCORSA', 'Sexualidad'],
			'description'   =>
				'Organiza charlas, debates, videofórums y otras actividades para ' .
				'informar y formar sobre temas de salud reproductiva y sexualidad.',
		],

		'Derechos humanos' => [
			'color'         => '#44b724',
			'parent'        => 'Grupos de trabajo temático',
			'ifmsa_name'    => 'Standing Committee On Human Rights and Peace',
			'ifmsa_acronym' => 'SCORP',
			'tags'          => ['SCORP', 'Derechos humanos'],
			'description'   =>
				'Organiza actividades relacionadas con la paz, los refugiados y los derechos' .
				'humanos, poniendo énfasis en la concienciación sobre desigualdad, '          .
				'intolerancia, racismo, violencia y abuso a las personas.',
		],

		'Intercambios internacionales clínicos' => [
			'parent'        => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On Professional Exchanges',
			'ifmsa_acronym' => 'SCOPE',
			'tags'          => [
				'SCOPE', 'Intercambios internacionales', 'Intercambios clínicos',
			],
			'description'   =>
				'Gestiona los intercambios clínicos entre universidades de todo el mundo. Los ' .
				'intercambios clínicos solo están disponibles para socios a partir de 3r curso.',
		],

		'Intercambios internacionales de investigación' => [
			'parent'        => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On Research Exchanges',
			'ifmsa_acronym' => 'SCORE',
			'tags'          => [
				'SCOPE', 'Intercambios internacionales', 'Intercambios de investigación',
			],
			'description'   =>
				'Gestiona intercambios ligados a proyectos de investigación internacional '      .
				'entre universidades de todo el mundo. Los intercambios de investigación están ' .
				'disponibles para estudiantes de todos los cursos.',
		],

		'Intercambios nacionales' => [
			'parent'        => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On National Exchanges',
			'ifmsa_acronym' => 'SCONE',
			'tags'          => ['SCONE', 'Intercambios nacionales'],
			'description'   =>
				'Gestiona los intercambios entre universidades españolas, tanto para los que ' .
				'vienen (incomings) como para los que se van (outgoings). Coordinan tanto '    .
				'intercambios clínicos (o profesionales) como de investigación.',
		],

		'Coordinación de acogida de intercambios' => [
			'parent'        => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On Incoming Hosting',
			'ifmsa_acronym' => 'SCOIH',
			'tags'          => ['SCOIH'],
			'description'   =>
				'Ajusta el programa de intercambios al presupuesto pautado por tesorería, ' .
				'gestiona el programa «acoge un guiri», coordina la acogida de incomings '  .
				'(condiciones, distribución y otras características del alojamiento) y es ' .
				'responsable de los Contact Person.',
		],

	];

	const CHARGES = [

		'presidencia@avem.es' => [
			'name'          => 'Presidencia',
			'working_group' => 'Cargos burocráticos',
			'roles'         => [ 'bureaucracy_r', 'finances_r', 'help_r'],
			'description'   =>
				'Representa oficial y legalmente a la Asociación y es responsable de las '    .
				'relaciones externas —con otras asociaciones, personalidades y organismos. '  .
				'Coordina y supervisa el trabajo de la Asociación, tiene poder para adoptar'  .
				'medidas urgentes y es responsable de convocar las Asambleas Generales y las' .
				'reuniones de Junta Directiva.',
		],

		'vicepresidencia@avem.es' => [
			'name'          => 'Vicepresidencia',
			'working_group' => 'Cargos burocráticos',
			'roles'         => ['bureaucracy_r', 'finances_r', 'help_r'],
			'description'   =>
				'Sustituye el cargo de presidencia en ausencia de éste. Supervisa y participa' .
				'en el correcto funcionamiento de las actividades y los cargos de la '         .
				'asociación, además de identificar problemas potenciales y actuar en '         .
				'consecuencia antes de que se manifiesten. Trabaja cercanamente con la '       .
				'Presidencia y el Responsable de Comunicación para transmitir una imagen '     .
				'corporativa coherente de la Asociación, elaborar campañas de márketing, y '   .
				'comunicar de forma eficaz.',
		],

		'tesoreria@avem.es' => [
			'name'          => 'Tesorería',
			'working_group' => 'Cargos burocráticos',
			'roles'         => ['bureaucracy_r', 'finances_r', 'help_r'],
			'description'   =>
				'Ordena, autoriza, registra, justifica y gestiona los movimientos monetarios de ' .
				'la Asociación en consonancia con Presidencia. Además, se encarga de buscar '     .
				'subvenciones y recaudar fondos para la Asociación.',
		],

		'secretaria@avem.es' => [
			'name'          => 'Secretaría',
			'working_group' => 'Cargos burocráticos',
			'roles'         => ['bureaucracy_r', 'finances_r', 'help_r'],
			'description'   =>
				'Es responsable de los trabajos administrativos de la Asociación: toma actas de las ' .
				'reuniones, hace certificados y documentos, presenta papeles, y actualiza la lista '  .
				'de contactos útiles para AVEM.',
		],

		'comunicacion@avem.es' => [
			'name'          => 'Responsable de comunicación',
			'working_group' => 'Cargos de apoyo',
			'roles'         => ['help_r'],
			'description'   =>
				'Es un community manager. Su trabajo consiste en difundir las actividades de la '  .
				'Asociación vía correo-e, Facebook, Instagram, entre otros medios. Además, puede ' .
				'informar de otras actividades que AVEM apoya, advertir de plazos importantes y '  .
				'resolver dudas frente a socios.',
		],

		'webmaster@avem.es' => [
			'name'          => 'Webmaster',
			'working_group' => 'Cargos de apoyo',
			'roles'         => ['admin_r'],
			'description'   =>
				'Su trabajo consiste en mantener la página web (incluyendo el blog de AVEM), y facilitar ' .
				'el acceso y la formación sobre las herramientas informáticas necesarias para el '         .
				'funcionamiento de la Asociación. También atiende dudas técnicas por correo (olvido de '   .
				'contraseña, renovación, etc) y hace las veces de servicio técnico.',
		],

		'lome@avem.es' => [
			'name'          => 'Responsable de educación médica',
			'ifmsa_name'    => 'Local Officer of Medical Education',
			'ifmsa_acronym' => 'LOME',
			'working_group' => 'Educación médica',
			'roles'         => ['activities_r', 'help_r'],
			'description'   =>
				'Se encarga de la formación médica complementaria, ampliándola mediante '  .
				'charlas, cursillos y otras actividades. Además, trabaja el estado de la ' .
				'educación médica y la docencia.',
		],

		'lome2@avem.es' => [
			'name'          => 'Responsable de educación médica',
			'ifmsa_name'    => 'Local Officer of Medical Education',
			'ifmsa_acronym' => 'LOME',
			'working_group' => 'Educación médica',
			'roles'         => ['activities_r', 'help_r'],
			'description'   =>
				'Se encarga de la formación médica complementaria, ampliándola mediante '  .
				'charlas, cursillos y otras actividades. Además, trabaja el estado de la ' .
				'educación médica y la docencia.',
		],

		'lpo@avem.es' => [
			'name'          => 'Responsable de salud pública',
			'ifmsa_name'    => 'Local Officer of Public Health',
			'ifmsa_acronym' => 'LPO',
			'working_group' => 'Salud pública',
			'roles'         => ['activities_r', 'help_r'],
			'description'   =>
				'Organiza actividades para informar sobre cómo prevenir enfermedades, ' .
				'mantener un estado de salud adecuado y acercar la medicina al ámbito ' .
				'público. Entre sus actividades estrella se encuentra la famosa Feria ' .
				'de la Salud por el Día Mundial de la Salud (DMS).',
		],

		'lpo2@avem.es' => [
			'name'          => 'Responsable de salud pública',
			'ifmsa_name'    => 'Local Officer of Public Health',
			'ifmsa_acronym' => 'LPO',
			'working_group' => 'Salud pública',
			'roles'         => ['activities_r', 'help_r'],
			'description'   =>
				'Organiza actividades para informar sobre cómo prevenir enfermedades, ' .
				'mantener un estado de salud adecuado y acercar la medicina al ámbito ' .
				'público. Entre sus actividades estrella se encuentra la famosa Feria ' .
				'de la Salud por el Día Mundial de la Salud (DMS).',
		],

		'lpo3@avem.es' => [
			'name'          => 'Responsable de salud pública',
			'ifmsa_name'    => 'Local Officer of Public Health',
			'ifmsa_acronym' => 'LPO',
			'working_group' => 'Salud pública',
			'roles'         => ['activities_r', 'help_r'],
			'description'   =>
				'Organiza actividades para informar sobre cómo prevenir enfermedades, ' .
				'mantener un estado de salud adecuado y acercar la medicina al ámbito ' .
				'público. Entre sus actividades estrella se encuentra la famosa Feria ' .
				'de la Salud por el Día Mundial de la Salud (DMS).',
		],

		'lorsa@avem.es' => [
			'name'          => 'Responsable de sexualidad',
			'ifmsa_name'    => 'Local Officer of Reproductive health and Sexuality including HIV/AIDS',
			'ifmsa_acronym' => 'LORSA',
			'working_group' => 'Sexualidad',
			'roles'         => ['activities_r', 'help_r'],
			'description'   =>
				'Organiza charlas, debates, videofórums y otras actividades para ' .
				'informar y formar sobre temas de salud reproductiva y sexualidad.',
		],

		'lorsa2@avem.es' => [
			'name'          => 'Responsable de sexualidad',
			'ifmsa_name'    => 'Local Officer of Reproductive health and Sexuality including HIV/AIDS',
			'ifmsa_acronym' => 'LORSA',
			'working_group' => 'Sexualidad',
			'roles'         => ['activities_r', 'help_r'],
			'description'   =>
				'Organiza charlas, debates, videofórums y otras actividades para ' .
				'informar y formar sobre temas de salud reproductiva y sexualidad.',
		],

		'lorp@avem.es' => [
			'name'          => 'Responsable de derechos humanos',
			'ifmsa_name'    => 'Local Officer of human Rights and Peace',
			'ifmsa_acronym' => 'LORP',
			'working_group' => 'Derechos humanos',
			'roles'         => ['activities_r', 'help_r'],
			'description'   =>
				'Organiza actividades relacionadas con la paz, los refugiados y los derechos' .
				'humanos, poniendo énfasis en la concienciación sobre desigualdad, '          .
				'intolerancia, racismo, violencia y abuso a las personas.',
		],

		'lorp2@avem.es' => [
			'name'          => 'Responsable de derechos humanos',
			'ifmsa_name'    => 'Local Officer of human Rights and Peace',
			'ifmsa_acronym' => 'LORP',
			'working_group' => 'Derechos humanos',
			'roles'         => ['activities_r', 'help_r'],
			'description'   =>
				'Organiza actividades relacionadas con la paz, los refugiados y los derechos' .
				'humanos, poniendo énfasis en la concienciación sobre desigualdad, '          .
				'intolerancia, racismo, violencia y abuso a las personas.',
		],

		'leo@avem.es' => [
			'name'          => 'Responsable de intercambios internacionales clínicos',
			'ifmsa_name'    => 'Local Exchange Officer',
			'ifmsa_acronym' => 'LEO',
			'working_group' => 'Intercambios internacionales clínicos',
			'roles'         => ['exchanges_r', 'help_r'],
			'description'   =>
				'Gestiona los intercambios clínicos entre universidades de todo el mundo. Los ' .
				'intercambios clínicos solo están disponibles para socios a partir de 3r curso.',
		],

		'leo2@avem.es' => [
			'name'          => 'Responsable de intercambios internacionales clínicos',
			'ifmsa_name'    => 'Local Exchange Officer',
			'ifmsa_acronym' => 'LEO',
			'working_group' => 'Intercambios internacionales clínicos',
			'roles'         => ['exchanges_r', 'help_r'],
			'description'   =>
				'Gestiona los intercambios clínicos entre universidades de todo el mundo. Los ' .
				'intercambios clínicos solo están disponibles para socios a partir de 3r curso.',
		],

		'lore@avem.es' => [
			'name'          => 'Responsable de intercambios internacionales de investigación',
			'ifmsa_name'    => 'Local Officer of Research Exchanges',
			'ifmsa_acronym' => 'LORE',
			'working_group' => 'Intercambios internacionales de investigación',
			'roles'         => ['exchanges_r', 'help_r'],
			'description'   =>
				'Gestiona intercambios ligados a proyectos de investigación internacional '      .
				'entre universidades de todo el mundo. Los intercambios de investigación están ' .
				'disponibles para estudiantes de todos los cursos.',
		],

		'lone@avem.es' => [
			'name'          => 'Responsable de intercambios nacionales',
			'ifmsa_name'    => 'Local Officer of National Exchanges',
			'ifmsa_acronym' => 'LONE',
			'working_group' => 'Intercambios nacionales',
			'roles'         => ['exchanges_r', 'help_r'],
			'description'   =>
				'Gestiona los intercambios entre universidades españolas, tanto para los que ' .
				'vienen (incomings) como para los que se van (outgoings). Coordinan tanto '    .
				'intercambios clínicos (o profesionales) como de investigación.',
		],

		'lone2@avem.es' => [
			'name'          => 'Responsable de intercambios nacionales',
			'ifmsa_name'    => 'Local Officer of National Exchanges',
			'ifmsa_acronym' => 'LONE',
			'working_group' => 'Intercambios nacionales',
			'roles'         => ['exchanges_r', 'help_r'],
			'description'   =>
				'Gestiona los intercambios entre universidades españolas, tanto para los que ' .
				'vienen (incomings) como para los que se van (outgoings). Coordinan tanto '    .
				'intercambios clínicos (o profesionales) como de investigación.',
		],

		'incomings@avem.es' => [
			'name'          => 'Responsable de coordinación de acogida de intercambios',
			'ifmsa_name'    => 'Local Officer of Incoming Hosting',
			'ifmsa_acronym' => 'LOIH',
			'working_group' => 'Coordinación de acogida de intercambios',
			'roles'         => ['exchanges_r', 'help_r'],
			'description'   =>
				'Ajusta el programa de intercambios al presupuesto pautado por tesorería, ' .
				'gestiona el programa «acoge un guiri», coordina la acogida de incomings '  .
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
			$role = Role::create(array_merge([ 'name' => $name ], $info));
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
				$parentGroup = WorkingGroup::firstOrCreate([ 'name' => $parentName ], $parentInfo);
				$parentGroup->subgroups()->save($workingGroup);
			}
			
			if (isset($info['tags'])) {
				$workingGroup->tags()->saveMany(array_map(function($tagName) {
					return Tag::firstOrCreate([ 'name' => $tagName ]);
				}, $info['tags']));
			}
		}
	}

	private function initCharges()
	{
		foreach (static::CHARGES as $email => $info) {
			$charge = Charge::create(array_merge([ 'email' => $email ], $info));

			if (isset($info['roles'])) {
				$charge->chargeRoles()->saveMany(
					Role::whereIn('name', $info['roles'])->get()
				);
			}

			if (isset($info['working_group'])) {
				$groupName = $info['working_group'];
				$workingGroup = WorkingGroup::where('name', $groupName)->first();
				$workingGroup->charges()->save($charge);
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

			// ACL-related tables
			$this->initPermissions();
			$this->initRoles();

			// AVEM-specific tables
			$this->initWorkingGroups();
			$this->initCharges();

		});

		$this->info('Database initialized');
	}
}
