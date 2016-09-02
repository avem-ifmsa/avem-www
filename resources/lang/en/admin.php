<?php

return [

	'title' => 'AVEM / Admin',

	'nav' => [
		'manage' => 'Manage',
		'renewals' => 'Renewals',
		'exchanges' => 'Exchanges',
		'mbMembers' => 'MB Members',
		'activities' => 'Activities',
		'statistics' => 'Statistics',
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
		'mbMembers' => 'MB Members',
		'mbCharges' => 'MB Charges',
		'statistics' => 'Statistics',
		'activities' => 'Activities',
		'permissions' => 'Permissions',
	],

	'manage' => [

		'nav' => [
			'users' => 'Users',
			'roles' => 'Roles',
			'members' => 'Members',
			'mbCharges' => 'MB Charges',
			'mbMembers' => 'MB Members',
			'activities' => 'Activities',
			'permissions' => 'Permissions',
		],

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
				'no' => 'no',
				'id' => 'ID',
				'yes' => 'yes',
				'email' => 'Email',
				'points' => 'Points',
				'notApplicable' => 'n/a',
				'fullName' => 'Full Name',
				'isActive' => 'Is Active?',
			],

			'form' => [
				'userLabel' => 'User',
				'notApplicable' => 'n/a',
				'birthdayLabel' => 'Birthday',
				'lastNameLabel' => 'Last Name',
				'firstNameLabel' => 'First Name',
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
				'id' => 'ID',
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
				'notApplicable' => 'n/a',
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
				'tagsLabel' => 'Tags',
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

	'renewals' => [
		'memberId' => 'ID',
		'fullName' => 'Full Name',
		'activeUntil' => 'Active Until',
		'notApplicable' => 'n/a',
		'renewButton' => 'Renew',
		'yearsLabel' => 'year/s',
		'successMessage' => 'Member «:name» renewed until :until',
	],

	'mbMembers' => [

		'memberId' => 'ID',
		'fullName' => 'Full Name',
		'notApplicable' => 'n/a',
		'activateButton' => 'Activate',
		'activeUntil' => 'Active Until',
		'deactivateButton' => 'Deactivate',
		'currentCharge' => 'Current Charge',

		'activate' => [
			'successMessage' => 'Member «:name» activated as «:charge» until :until',
		],

		'deactivate' => [
			'successMessage' => 'Member «:name» with charge «:charge» deactivated',
		],
	],

];
