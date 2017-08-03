<?php

namespace Avem\Console\Commands;

use DB;
use Avem\Tag;
use Avem\Role;
use Avem\Charge;
use Carbon\Carbon;
use Avem\Permission;
use Avem\WorkingGroup;
use Illuminate\Console\Command;

class InitCommand extends Command
{

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

		// Administrator role
		[
			'name'         => 'admin_r',
			'description'  => 'Permite el control total sobre todos los recursos de la Asociación.',
			'_permissions' => [
				'activity:create', 'activity:view', 'activity:update', 'activity:delete',
				'charge:create', 'charge:view', 'charge:update', 'charge:renew', 'charge:delete',
				'exchange:create', 'exchange:view', 'exchange:update', 'exchange:delete',
				'user:create', 'user:view', 'user:renew', 'user:update', 'user:delete',
				'working-group:create', 'working-group:view', 'working-group:update', 'working-group:delete',
			],
		],

		// Finances role
		[
			'name'         => 'finances_r',
			'description'  => 'Permite efectuar las renovaciones de los socios.',
			'_permissions' => [
				'user:view', 'user:renew',
			],
		],

		// Activities role
		[
			'name'         => 'activities_r',
			'description'  => 'Permite crear y administrar actividades.',
			'_permissions' => [
				'activity:create',
			],
		],

		// Bureaucracy role
		[
			'name'         => 'bureaucracy_r',
			'description'  => 'Permite crear y administrar cargos y grupos de trabajo.',
			'_permissions' => [
				'charge:create', 'charge:view', 'charge:update', 'charge:renew', 'charge:delete',
				'working-group:create', 'working-group:view', 'working-group:update', 'working-group:delete',
			],
		],

		// Exchanges role
		[
			'name'         => 'exchanges_r',
			'description'  => 'Permite crear y administrar intercambios.',
			'_permissions' => [
				'exchange:create', 'exchange:view', 'exchange:update', 'exchange:delete',
			],
		],

		// Help role
		[
			'name'         => 'help_r',
			'description'  => 'Permite acceder a la información de los socios.',
			'_permissions' => [
				'activity:view',
				'user:view', 'user:update',
			],
		],

	];

	const WORKING_GROUPS = [

		// Cargos burocráticos
		[
			'index' => 0,
			'name'  => 'Cargos burocráticos',
			'color' => '#a01238',
		],

		// Grupos de trabajo temático
		[
			'index' => 1,
			'name'  => 'Grupos de trabajo temático',
		],

		// Cargos de apoyo
		[
			'index' => 2,
			'name'  => 'Cargos de apoyo',
			'color' => '#c8c800',
		],

		// Cargos de intercambios
		[
			'index' => 3,
			'name'  => 'Cargos de intercambios',
			'color' => '#1368d8',
		],

		// Cargos de trabajo temático > Educación médica
		[
			'index'         => 0,
			'name'          => 'Educación médica',
			'color'         => '#485b6b',
			'_parent'       => 'Grupos de trabajo temático',
			'ifmsa_name'    => 'Standing Committee On Medical Education',
			'ifmsa_acronym' => 'SCOME',
			'_tags'         => ['SCOME', 'Educación médica'],
			'description'   =>
				'Se encarga de la formación médica complementaria, ampliándola mediante '  .
				'charlas, cursillos y otras actividades. Además, trabaja el estado de la ' .
				'educación médica y la docencia.',
		],

		// Cargos de trabajo temático > Salud pública
		[
			'index'         => 1,
			'name'          => 'Salud pública',
			'color'         => '#ff8316',
			'_parent'       => 'Grupos de trabajo temático',
			'ifmsa_name'    => 'Standing Committee On Public Health',
			'ifmsa_acronym' => 'SCOPH',
			'_tags'         => ['SCOPH', 'Salud pública'],
			'description'   =>
				'Organiza actividades para informar sobre cómo prevenir enfermedades, ' .
				'mantener un estado de salud adecuado y acercar la medicina al ámbito ' .
				'público. Entre sus actividades estrella se encuentra la famosa Feria ' .
				'de la Salud por el Día Mundial de la Salud (DMS).',
		],

		// Cargos de trabajo temático > Sexualidad
		[
			'index'         => 2,
			'name'          => 'Sexualidad',
			'color'         => '#dc083c',
			'_parent'       => 'Grupos de trabajo temático',
			'ifmsa_name'    => 'Standing Committee On Reproductive health and Sexuality including HIV/AIDS',
			'ifmsa_acronym' => 'SCORSA',
			'_tags'         => ['SCORSA', 'Sexualidad'],
			'description'   =>
				'Organiza charlas, debates, videofórums y otras actividades para ' .
				'informar y formar sobre temas de salud reproductiva y sexualidad.',
		],

		// Cargos de trabajo temático > Derechos humanos
		[
			'index'         => 3,
			'name'          => 'Derechos humanos',
			'color'         => '#44b724',
			'_parent'       => 'Grupos de trabajo temático',
			'ifmsa_name'    => 'Standing Committee On Human Rights and Peace',
			'ifmsa_acronym' => 'SCORP',
			'_tags'         => ['SCORP', 'Derechos humanos'],
			'description'   =>
				'Organiza actividades relacionadas con la paz, los refugiados y los derechos' .
				'humanos, poniendo énfasis en la concienciación sobre desigualdad, '          .
				'intolerancia, racismo, violencia y abuso a las personas.',
		],

		// Cargos de intercambios > Intercambios nacionales
		[
			'index'         => 0,
			'name'          => 'Intercambios nacionales',
			'_parent'       => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On National Exchanges',
			'ifmsa_acronym' => 'SCONE',
			'_tags'         => ['SCONE', 'Intercambios nacionales'],
			'description'   =>
				'Gestiona los intercambios entre universidades españolas, tanto para los que ' .
				'vienen (incomings) como para los que se van (outgoings). Coordinan tanto '    .
				'intercambios clínicos (o profesionales) como de investigación.',
		],

		// Cargos de intercambios > Intercambios internacionales clínicos
		[
			'index'         => 1,
			'name'          => 'Intercambios internacionales clínicos',
			'_parent'       => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On Professional Exchanges',
			'ifmsa_acronym' => 'SCOPE',
			'_tags'         => [
				'SCOPE', 'Intercambios internacionales', 'Intercambios clínicos',
			],
			'description'   =>
				'Gestiona los intercambios clínicos entre universidades de todo el mundo. Los ' .
				'intercambios clínicos solo están disponibles para socios a partir de 3r curso.',
		],

		// Cargos de intercambios > Intercambios internacionales de investigación
		[
			'index'         => 2,
			'name'          => 'Intercambios internacionales de investigación',
			'_parent'       => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On Research Exchanges',
			'ifmsa_acronym' => 'SCORE',
			'_tags'         => [
				'SCOPE', 'Intercambios internacionales', 'Intercambios de investigación',
			],
			'description'   =>
				'Gestiona intercambios ligados a proyectos de investigación internacional '      .
				'entre universidades de todo el mundo. Los intercambios de investigación están ' .
				'disponibles para estudiantes de todos los cursos.',
		],

		// Cargos de intercambios > Coordinación de acogida de intercambios
		[
			'index'         => 3,
			'name'          => 'Coordinación de acogida de intercambios',
			'_parent'       => 'Cargos de intercambios',
			'ifmsa_name'    => 'Standing Committee On Incoming Hosting',
			'ifmsa_acronym' => 'SCOIH',
			'_tags'         => ['SCOIH'],
			'description'   =>
				'Ajusta el programa de intercambios al presupuesto pautado por tesorería, ' .
				'gestiona el programa «acoge un guiri», coordina la acogida de incomings '  .
				'(condiciones, distribución y otras características del alojamiento) y es ' .
				'responsable de los Contact Person.',
		],

	];

	const CHARGES = [

		// Presidencia <presidencia@avem.es>
		[
			'index'          => 0,
			'name'           => 'Presidencia',
			'email'          => 'presidencia@avem.es',
			'_working_group' => 'Cargos burocráticos',
			'_roles'         => [ 'bureaucracy_r', 'finances_r', 'help_r'],
			'description'    =>
				'Representa oficial y legalmente a la Asociación y es responsable de las '    .
				'relaciones externas —con otras asociaciones, personalidades y organismos. '  .
				'Coordina y supervisa el trabajo de la Asociación, tiene poder para adoptar'  .
				'medidas urgentes y es responsable de convocar las Asambleas Generales y las' .
				'reuniones de Junta Directiva.',
		],

		// Vicepresidencia <vicepresidencia@avem.es>
		[
			'index'          => 1,
			'name'           => 'Vicepresidencia',
			'email'          => 'vicepresidencia@avem.es',
			'_working_group' => 'Cargos burocráticos',
			'_roles'         => ['bureaucracy_r', 'finances_r', 'help_r'],
			'description'    =>
				'Sustituye el cargo de presidencia en ausencia de éste. Supervisa y participa' .
				'en el correcto funcionamiento de las actividades y los cargos de la '         .
				'asociación, además de identificar problemas potenciales y actuar en '         .
				'consecuencia antes de que se manifiesten. Trabaja cercanamente con la '       .
				'Presidencia y el Responsable de Comunicación para transmitir una imagen '     .
				'corporativa coherente de la Asociación, elaborar campañas de márketing, y '   .
				'comunicar de forma eficaz.',
		],

		// Tesorería <tesoreria@avem.es>
		[
			'index'          => 2,
			'name'           => 'Tesorería',
			'email'          => 'tesoreria@avem.es',
			'_working_group' => 'Cargos burocráticos',
			'_roles'         => ['bureaucracy_r', 'finances_r', 'help_r'],
			'description'    =>
				'Ordena, autoriza, registra, justifica y gestiona los movimientos monetarios de ' .
				'la Asociación en consonancia con Presidencia. Además, se encarga de buscar '     .
				'subvenciones y recaudar fondos para la Asociación.',
		],

		// Secretaría <secretaria@avem.es>
		[
			'index'          => 3,
			'name'           => 'Secretaría',
			'email'          => 'secretaria@avem.es',
			'_working_group' => 'Cargos burocráticos',
			'_roles'         => ['bureaucracy_r', 'finances_r', 'help_r'],
			'description'    =>
				'Es responsable de los trabajos administrativos de la Asociación: toma actas de las ' .
				'reuniones, hace certificados y documentos, presenta papeles, y actualiza la lista '  .
				'de contactos útiles para AVEM.',
		],

		// Comunicación <comunicacion@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de comunicación',
			'email'          => 'comunicacion@avem.es',
			'_working_group' => 'Cargos de apoyo',
			'_roles'         => ['help_r'],
			'description'    =>
				'Es un community manager. Su trabajo consiste en difundir las actividades de la '  .
				'Asociación vía correo-e, Facebook, Instagram, entre otros medios. Además, puede ' .
				'informar de otras actividades que AVEM apoya, advertir de plazos importantes y '  .
				'resolver dudas frente a socios.',
		],

		// Webmaster <webmaster@avem.es>
		[
			'index'          => 1,
			'name'           => 'Webmaster',
			'email'          => 'webmaster@avem.es',
			'_working_group' => 'Cargos de apoyo',
			'_roles'         => ['admin_r'],
			'description'    =>
				'Su trabajo consiste en mantener la página web (incluyendo el blog de AVEM), y facilitar ' .
				'el acceso y la formación sobre las herramientas informáticas necesarias para el '         .
				'funcionamiento de la Asociación. También atiende dudas técnicas por correo (olvido de '   .
				'contraseña, renovación, etc) y hace las veces de servicio técnico.',
		],

		// LOME <lome@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de educación médica',
			'ifmsa_name'     => 'Local Officer of Medical Education',
			'ifmsa_acronym'  => 'LOME',
			'email'          => 'lome@avem.es',
			'_working_group' => 'Educación médica',
			'_roles'         => ['activities_r', 'help_r'],
			'description'    =>
				'Se encarga de la formación médica complementaria, ampliándola mediante '  .
				'charlas, cursillos y otras actividades. Además, trabaja el estado de la ' .
				'educación médica y la docencia.',
		],

		// LOME <lome2@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de educación médica',
			'ifmsa_name'     => 'Local Officer of Medical Education',
			'ifmsa_acronym'  => 'LOME',
			'email'          => 'lome2@avem.es',
			'_working_group' => 'Educación médica',
			'_roles'         => ['activities_r', 'help_r'],
			'description'    =>
				'Se encarga de la formación médica complementaria, ampliándola mediante '  .
				'charlas, cursillos y otras actividades. Además, trabaja el estado de la ' .
				'educación médica y la docencia.',
		],

		// LPO <lpo@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de salud pública',
			'ifmsa_name'     => 'Local Officer of Public Health',
			'ifmsa_acronym'  => 'LPO',
			'email'          => 'lpo@avem.es',
			'_working_group' => 'Salud pública',
			'_roles'         => ['activities_r', 'help_r'],
			'description'    =>
				'Organiza actividades para informar sobre cómo prevenir enfermedades, ' .
				'mantener un estado de salud adecuado y acercar la medicina al ámbito ' .
				'público. Entre sus actividades estrella se encuentra la famosa Feria ' .
				'de la Salud por el Día Mundial de la Salud (DMS).',
		],

		// LPO <lpo2@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de salud pública',
			'ifmsa_name'     => 'Local Officer of Public Health',
			'ifmsa_acronym'  => 'LPO',
			'email'          => 'lpo2@avem.es',
			'_working_group' => 'Salud pública',
			'_roles'         => ['activities_r', 'help_r'],
			'description'    =>
				'Organiza actividades para informar sobre cómo prevenir enfermedades, ' .
				'mantener un estado de salud adecuado y acercar la medicina al ámbito ' .
				'público. Entre sus actividades estrella se encuentra la famosa Feria ' .
				'de la Salud por el Día Mundial de la Salud (DMS).',
		],

		// LPO <lpo3@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de salud pública',
			'ifmsa_name'     => 'Local Officer of Public Health',
			'ifmsa_acronym'  => 'LPO',
			'email'          => 'lpo3@avem.es',
			'_working_group' => 'Salud pública',
			'_roles'         => ['activities_r', 'help_r'],
			'description'    =>
				'Organiza actividades para informar sobre cómo prevenir enfermedades, ' .
				'mantener un estado de salud adecuado y acercar la medicina al ámbito ' .
				'público. Entre sus actividades estrella se encuentra la famosa Feria ' .
				'de la Salud por el Día Mundial de la Salud (DMS).',
		],

		// LORSA <lorsa@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de sexualidad',
			'ifmsa_name'     => 'Local Officer of Reproductive health and Sexuality including HIV/AIDS',
			'ifmsa_acronym'  => 'LORSA',
			'email'          => 'lorsa@avem.es',
			'_working_group' => 'Sexualidad',
			'_roles'         => ['activities_r', 'help_r'],
			'description'    =>
				'Organiza charlas, debates, videofórums y otras actividades para ' .
				'informar y formar sobre temas de salud reproductiva y sexualidad.',
		],

		// LORSA <lorsa2@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de sexualidad',
			'ifmsa_name'     => 'Local Officer of Reproductive health and Sexuality including HIV/AIDS',
			'ifmsa_acronym'  => 'LORSA',
			'email'          => 'lorsa2@avem.es',
			'_working_group' => 'Sexualidad',
			'_roles'         => ['activities_r', 'help_r'],
			'description'    =>
				'Organiza charlas, debates, videofórums y otras actividades para ' .
				'informar y formar sobre temas de salud reproductiva y sexualidad.',
		],

		// LORP <lorp@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de derechos humanos',
			'ifmsa_name'     => 'Local Officer of human Rights and Peace',
			'ifmsa_acronym'  => 'LORP',
			'email'          => 'lorp@avem.es',
			'_working_group' => 'Derechos humanos',
			'_roles'         => ['activities_r', 'help_r'],
			'description'    =>
				'Organiza actividades relacionadas con la paz, los refugiados y los derechos' .
				'humanos, poniendo énfasis en la concienciación sobre desigualdad, '          .
				'intolerancia, racismo, violencia y abuso a las personas.',
		],

		// LORP <lorp2@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de derechos humanos',
			'ifmsa_name'     => 'Local Officer of human Rights and Peace',
			'ifmsa_acronym'  => 'LORP',
			'email'          => 'lorp2@avem.es',
			'_working_group' => 'Derechos humanos',
			'_roles'         => ['activities_r', 'help_r'],
			'description'    =>
				'Organiza actividades relacionadas con la paz, los refugiados y los derechos' .
				'humanos, poniendo énfasis en la concienciación sobre desigualdad, '          .
				'intolerancia, racismo, violencia y abuso a las personas.',
		],

		// LEO <leo@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de intercambios internacionales clínicos',
			'ifmsa_name'     => 'Local Exchange Officer',
			'ifmsa_acronym'  => 'LEO',
			'email'          => 'leo@avem.es',
			'_working_group' => 'Intercambios internacionales clínicos',
			'_roles'         => ['exchanges_r', 'help_r'],
			'description'    =>
				'Gestiona los intercambios clínicos entre universidades de todo el mundo. Los ' .
				'intercambios clínicos solo están disponibles para socios a partir de 3r curso.',
		],

		// LEO <leo2@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de intercambios internacionales clínicos',
			'ifmsa_name'     => 'Local Exchange Officer',
			'ifmsa_acronym'  => 'LEO',
			'email'          => 'leo2@avem.es',
			'_working_group' => 'Intercambios internacionales clínicos',
			'_roles'         => ['exchanges_r', 'help_r'],
			'description'    =>
				'Gestiona los intercambios clínicos entre universidades de todo el mundo. Los ' .
				'intercambios clínicos solo están disponibles para socios a partir de 3r curso.',
		],

		// LORE <lore@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de intercambios internacionales de investigación',
			'ifmsa_name'     => 'Local Officer of Research Exchanges',
			'ifmsa_acronym'  => 'LORE',
			'email'          => 'lore@avem.es',
			'_working_group' => 'Intercambios internacionales de investigación',
			'_roles'         => ['exchanges_r', 'help_r'],
			'description'    =>
				'Gestiona intercambios ligados a proyectos de investigación internacional '      .
				'entre universidades de todo el mundo. Los intercambios de investigación están ' .
				'disponibles para estudiantes de todos los cursos.',
		],

		// LONE <lone@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de intercambios nacionales',
			'ifmsa_name'     => 'Local Officer of National Exchanges',
			'ifmsa_acronym'  => 'LONE',
			'email'          => 'lone@avem.es',
			'_working_group' => 'Intercambios nacionales',
			'_roles'         => ['exchanges_r', 'help_r'],
			'description'    =>
				'Gestiona los intercambios entre universidades españolas, tanto para los que ' .
				'vienen (incomings) como para los que se van (outgoings). Coordinan tanto '    .
				'intercambios clínicos (o profesionales) como de investigación.',
		],

		// LONE <lone2@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de intercambios nacionales',
			'ifmsa_name'     => 'Local Officer of National Exchanges',
			'ifmsa_acronym'  => 'LONE',
			'email'          => 'lone2@avem.es',
			'_working_group' => 'Intercambios nacionales',
			'_roles'         => ['exchanges_r', 'help_r'],
			'description'    =>
				'Gestiona los intercambios entre universidades españolas, tanto para los que ' .
				'vienen (incomings) como para los que se van (outgoings). Coordinan tanto '    .
				'intercambios clínicos (o profesionales) como de investigación.',
		],

		// LOIH <incomings@avem.es>
		[
			'index'          => 0,
			'name'           => 'Responsable de coordinación de acogida de intercambios',
			'ifmsa_name'     => 'Local Officer of Incoming Hosting',
			'ifmsa_acronym'  => 'LOIH',
			'email'          => 'incomings@avem.es',
			'_working_group' => 'Coordinación de acogida de intercambios',
			'_roles'         => ['exchanges_r', 'help_r'],
			'description'    =>
				'Ajusta el programa de intercambios al presupuesto pautado por tesorería, ' .
				'gestiona el programa «acoge un guiri», coordina la acogida de incomings '  .
				'(condiciones, distribución y otras características del alojamiento) y es ' .
				'responsable de los Contact Person.',
		],

	];

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	private function hidePrivateFields($items)
	{
		return array_map(function($info) {
			return array_reduce(array_keys($info) , function($data, $propKey) use ($info) {
				if ($propKey[0] !== '_')
					$data[$propKey] = $info[$propKey];
				return $data;
			}, []);
		}, $items);
	}

	private function addMissingFields($items)
	{
		$fields = array_reduce($items, function($fields, $info) {
			foreach (array_keys($info) as $f) {
				if (!in_array($f, $fields))
					array_push($fields, $f);
			}
			return $fields;
		}, []);

		return array_map(function($info) use ($fields) {
			return array_reduce($fields, function($data, $f) {
				if (!isset($data[$f]))
					$data[$f] = null;
				return $data;
			}, $info);
		}, $items);
	}

	private function addTimestamps($items, $now)
	{
		return array_map(function($data) use ($now) {
			return array_merge($data, [
				'created_at' => $now,
				'updated_at' => $now,
			]);
		}, $items);
	}

	private function prepareData($items, $now)
	{
		$items = $this->hidePrivateFields($items);
		$items = $this->addMissingFields($items);
		$items = $this->addTimestamps($items, $now);
		return $items;
	}

	private function initPermissions($now)
	{
		Permission::insert($this->prepareData(static::PERMISSIONS, $now));

		$this->info('Creating permissions... Done');
	}

	private function initRoles($now)
	{
		Role::insert($this->prepareData(static::ROLES, $now));

		$roleData = array_reduce(static::ROLES, function($roleData, $roleInfo) {
			$roleData[$roleInfo['name']] = $roleInfo;
			return $roleData;
		}, []);

		$roleNames = array_keys($roleData);
		foreach (Role::whereIn('name', $roleNames)->get() as $role) {
			$roleInfo = $roleData[$role->name];
			$role->permissions()->saveMany(
				Permission::whereIn('name', $roleInfo['_permissions'])->get()
			);
		}

		$this->info('Creating roles... Done');
	}

	private function initWorkingGroups($now)
	{
		WorkingGroup::insert($this->prepareData(static::WORKING_GROUPS, $now));

		$groupData = array_reduce(static::WORKING_GROUPS, function($groupData, $groupInfo) {
			$groupData[$groupInfo['name']] = $groupInfo;
			return $groupData;
		}, []);

		$groupNames = array_keys($groupData);
		$workingGroups = WorkingGroup::whereIn('name', $groupNames)->get();
		foreach ($workingGroups as $workingGroup) {
			$groupInfo = $groupData[$workingGroup->name];

			if (isset($groupInfo['_parent'])) {
				$parentName = $groupInfo['_parent'];
				$parentGroup = $workingGroups->where('name', $parentName)->first();
				$parentGroup->subgroups()->save($workingGroup);
			}

			if (isset($groupInfo['_tags'])) {
				$workingGroup->tags()->saveMany(array_map(function($tagName) {
					return Tag::firstOrCreate([ 'name' => $tagName ]);
				}, $groupInfo['_tags']));
			}
		}

		$this->info('Creating working groups... Done');
	}

	private function initCharges($now)
	{
		Charge::insert($this->prepareData(static::CHARGES, $now));

		$chargeData = array_reduce(static::CHARGES, function($chargeData, $chargeInfo) {
			$chargeData[$chargeInfo['email']] = $chargeInfo;
			return $chargeData;
		}, []);

		$chargeEmails = array_keys($chargeData);
		foreach (Charge::whereIn('email', $chargeEmails)->get() as $charge) {
			$chargeInfo = $chargeData[$charge->email];

			if (isset($chargeInfo['_roles'])) {
				$charge->roles()->saveMany(
					Role::whereIn('name', $chargeInfo['_roles'])->get()
				);
			}

			if (isset($chargeInfo['_working_group'])) {
				$groupName = $chargeInfo['_working_group'];
				$workingGroup = WorkingGroup::where('name', $groupName)->first();
				$workingGroup->charges()->save($charge);
			}
		}

		$this->info('Creating charges... Done');
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$now = Carbon::now();
		DB::transaction(function() use ($now) {

			// ACL-related tables
			$this->initPermissions($now);
			$this->initRoles($now);

			// AVEM-specific tables
			$this->initWorkingGroups($now);
			$this->initCharges($now);

		});

		$this->info('Database initialized');
	}
}
