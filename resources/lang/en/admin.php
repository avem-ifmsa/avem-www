<?php

return [

	'title' => 'Avem / Admin',
	'header' => 'AVEM Administration Panel',

	'nav' => [
		'users' => 'Users',
		'roles' => 'Roles',
		'manage' => 'Manage',
		'members' => 'Members',
		'renewals' => 'Renewals',
		'exchanges' => 'Exchanges',
		'analytics' => 'Analytics',
		'mbCharges' => 'MB Charges',
		'mbMembers' => 'MB Members',
		'activities' => 'Activities',
		'permissions' => 'Permissions',
	],

	'breadcrumb' => [
		'edit' => 'Edit',
		'admin' => 'Admin',
		'users' => 'Users',
		'roles' => 'Roles',
		'create' => 'Create',
		'manage' => 'Manage',
		'members' => 'Members',
		'renewals' => 'Renewals',
		'exchanges' => 'Exchanges',
		'analytics' => 'Analytics',
		'mbMembers' => 'MB Members',
		'mbCharges' => 'MB Charges',
		'activities' => 'Activities',
		'permissions' => 'Permissions',
	],

	'manage' => [

		'actions' => [
			'editButton' => 'Edit',
			'deleteButton' => 'Delete',
			'createButton' => 'Create new',
		],

		'permissions' => [

			'index' => [
				'name' => 'Name',
				'displayName' => 'Display Name',
				'description' => 'Description',
			],

			'form' => [
				'nameLabel' => 'Name',
				'displayNameLabel' => 'Display Name',
				'descriptionLabel' => 'Description',
			],

			'create' => [
				'submitButton' => 'Create permission',
				'successMessage' => 'Permission created',
			],

			'edit' => [
				'submitButton' => 'Save permission',
				'successMessage' => 'Updated permission info',
			],

			'delete' => [
				'successMessage' => 'Permission deleted',
			],

		],

		'roles' => [

			'index' => [
				'name' => 'Name',
				'displayName' => 'Display Name',
				'description' => 'Description',
			],

			'form' => [
				'nameLabel' => 'Name',
				'displayNameLabel' => 'Display Name',
				'descriptionLabel' => 'Description',
				'permissionsLabel' => 'Permissions',
			],

			'create' => [
				'submitButton' => 'Create new role',
				'successMessage' => 'Role created',
			],

			'edit' => [
				'submitButton' => 'Save role',
				'successMessage' => 'Updated role info',
			],

			'delete' => [
				'successMessage' => 'Role deleted',
			],

		],

		'users' => [

			'index' => [
				'email' => 'Email',
				'member' => 'Member',
				'notApplicable' => 'n/a',
			],

			'form' => [
				'emailLabel' => 'Email',
				'passwordLabel' => 'Password',
				'rolesLabel' => 'Roles',
				'memberLabel' => 'Member',
			],

			'create' => [
				'submitButton' => 'Create new user',
				'successMessage' => 'User created',
			],

			'edit' => [
				'submitButton' => 'Save user',
				'successMessage' => 'Updated user info',
			],

			'delete' => [
				'successMessage' => 'User deleted',
			],

		],

		'members' => [

			'index' => [
				'fullName' => 'Full Name',
				'isActive' => 'Is Active?',
				'points' => 'Points',
				'yes' => 'yes',
				'no' => 'no',
			],

			'form' => [
				'firstNameLabel' => 'First Name',
				'lastNameLabel' => 'Last Name',
				'genderLabel' => 'Gender',
				'birthdayLabel' => 'Birthday',
				'genderOptions' => [
					'male' => 'Male',
					'female' => 'Female',
					'other' => 'Other',
				],
			],

			'create' => [
				'submitButton' => 'Create new member',
				'successMessage' => 'Member created',
			],

			'edit' => [
				'submitButton' => 'Save member',
				'successMessage' => 'Updated member info',
			],

			'delete' => [
				'successMessage' => 'Deleted member',
			],

		],

		'mbCharges' => [

			'index' => [
				'name' => 'Name',
				'email' => 'Email',
			],

			'form' => [
				'nameLabel' => 'Name',
				'emailLabel' => 'Email',
				'descriptionLabel' => 'Description',
			],

			'create' => [
				'submitButton' => 'Create new MB charge',
				'successMessage' => 'MB charge created',
			],

			'edit' => [
				'submitButton' => 'Save MB charge',
				'successMessage' => 'Updated MB charge info',
			],

			'delete' => [
				'successMessage' => 'Deleted MB charge',
			],

		],

		'mbMembers' => [

			'index' => [
				'phone' => 'Phone',
				'member' => 'Member',
				'dniNif' => 'DNI/NIF',
				'notApplicable' => 'n/a',
				'isActive' => 'Is Active?',
				'yes' => 'yes',
				'no' => 'no',
			],

			'form' => [
				'phoneLabel' => 'Phone',
				'memberLabel' => 'Member',
				'dniNifLabel' => 'DNI/NIF',
			],

			'create' => [
				'submitButton' => 'Create new MB member',
				'successMessage' => 'MB member created',
			],

			'edit' => [
				'submitButton' => 'Save MB member',
				'successMessage' => 'Updated MB member info',
			],

			'delete' => [
				'successMessage' => 'Deleted MB member',
			],

		],

		'activities' => [

			'index' => [
				'end' => 'End',
				'name' => 'Name',
				'start' => 'Start',
				'isPublic' => 'Is Public?',
				'isAvailable' => 'Is Available?',
				'yes' => 'yes',
				'no' => 'no',
			],

			'form' => [
				'nameLabel' => 'Name',
				'isPublicLabel' => 'Public',
				'locationLabel' => 'Location',
				'descriptionLabel' => 'Description',
				'startLabel' => 'Activity starts on',
				'endLabel' => 'Activity ends on',
				'subscriptionStartLabel' => 'Subscription starts on',
				'subscriptionEndLabel' => 'Subscription ends on',
				'organizersLabel' => 'Organizers',
			],

			'create' => [
				'submitButton' => 'Create new activity',
				'successMessage' => 'Activity created',
			],

			'edit' => [
				'submitButton' => 'Save activity',
				'successMessage' => 'Updated activity info',
			],

			'delete' => [
				'successMessage' => 'Deleted activity',
			],

		],

	],

];
