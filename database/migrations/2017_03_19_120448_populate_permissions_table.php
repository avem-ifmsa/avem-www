<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulatePermissionsTable extends Migration
{
	const VALUES = [

		// Activity permissions
		['name' => 'activity:create', 'description' => 'Permiso para crear nuevas actividades'],
		['name' => 'activity:view'  , 'description' => 'Permiso para ver actividades creadas por otros'],
		['name' => 'activity:update', 'description' => 'Permiso para modificar actividades creadas por otros'],
		['name' => 'activity:delete', 'description' => 'Permiso para eliminar actividades creadas por otros'],

		// Charge permissions
		['name' => 'charge:create', 'description' => 'Permiso para crear nuevos cargos de junta'],
		['name' => 'charge:view'  , 'description' => 'Permiso para ver información sobre los cargos de junta'],
		['name' => 'charge:update', 'description' => 'Permiso para modificar información sobre los cargos de junta'],
		['name' => 'charge:delete', 'description' => 'Permiso para eliminar cargos de junta'],

		// Exchange permissions
		['name' => 'exchange:create', 'description' => 'Permiso para crear nuevos intercambios'],
		['name' => 'exchange:view'  , 'description' => 'Permiso para ver información sobre los intercambios existentes'],
		['name' => 'exchange:update', 'description' => 'Permiso para modificar información sobre los intercambios'],
		['name' => 'exchange:delete', 'description' => 'Permiso para eliminar intercambios'],

		// MbMember permissions
		['name' => 'mb-member:create', 'description' => 'Permiso para dar de alta miembros de junta'],
		['name' => 'mb-member:view'  , 'description' => 'Permiso para ver información sobre los miembros de junta'],
		['name' => 'mb-member:update', 'description' => 'Permiso para modificar la información de los miembros de junta'],
		['name' => 'mb-member:renew' , 'description' => 'Permiso para renovar los cargos de junta'],
		['name' => 'mb-member:delete', 'description' => 'Permiso para eliminar miembros de junta'],

		// User permissions
		['name' => 'user:create', 'description' => 'Permiso para crear nuevos socios'],
		['name' => 'user:view'  , 'description' => 'Permiso para ver la información de los socios'],
		['name' => 'user:update', 'description' => 'Permiso para modificar la información de los socios'],
		['name' => 'user:renew' , 'description' => 'Permiso para renovar a los socios'],
		['name' => 'user:delete', 'description' => 'Permiso para eliminar socios'],

		// WorkingGroup permissions
		['name' => 'working-group:create', 'description' => 'Permiso para crear nuevos grupos de trabajo'],
		['name' => 'working-group:view'  , 'description' => 'Permiso para ver información sobre los grupos de trabajo'],
		['name' => 'working-group:update', 'description' => 'Permiso para modificar la información de los grupos de trabajo'],
		['name' => 'working-group:delete', 'description' => 'Permiso para eliminar grupos de trabajo'],

	];

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('permissions')->insert(static::VALUES);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$names = array_column(static::VALUES, 'name');
		DB::table('permissions')->whereIn('name', $names)->delete();
	}
}
