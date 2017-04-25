<?php

namespace Avem\Console\Commands;

use Avem\User;
use Avem\Role;
use Illuminate\Console\Command;

class AddUserCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'avem:adduser {--y|assumeyes}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new user';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$info = [
			'name'     => $this->ask('First Name'),
			'surname'  => $this->ask('Last Name'),
			'email'    => $this->ask('Email Address'),
			'password' => \Hash::make($this->secret('Password')),
		];

		while ($name = $this->ask('Roles (empty line to quit)', false)) {
			$role = Role::where('name', $name)->first();
			if (!$role) {
				$this->error("Role '$name' does not exist");
			} else {
				$roles[] = $role;
			}
		}

		if ($this->option('assumeyes') || $this->confirm('Is everything correct')) {
			$user = User::create($info);
			$user->ownRoles()->saveMany($roles);
			$this->info('User created successfully');
		}
	}
}
