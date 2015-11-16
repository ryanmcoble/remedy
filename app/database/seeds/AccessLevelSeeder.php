<?php

class AccessLevelSeeder extends Seeder
{

	public function run()
	{

		$seedData = [
			[
				'title'          => 'Administrator',
				'level'          => 1337,
				'request_limit'  => 9999999,
				'interval_type'  => 'second',
				'interval_value' => 1
			],
			[
				'title'          => 'Free',
				'level'          => 1,
				'request_limit'  => 1000,
				'interval_type'  => 'hour',
				'interval_value' => 1
			],
			[
				'title'          => 'Free Plus',
				'level'          => 2,
				'request_limit'  => 5000,
				'interval_type'  => 'hour',
				'interval_value' => 1
			],
			[
				'title'          => 'Bronze',
				'level'          => 3,
				'request_limit'  => 10000,
				'interval_type'  => 'hour',
				'interval_value' => 1
			],
			[
				'title'          => 'Gold',
				'level'          => 4,
				'request_limit'  => 5000,
				'interval_type'  => 'minute',
				'interval_value' => 1
			],
			[
				'title'          => 'Platinum',
				'level'          => 5,
				'request_limit'  => 10000,
				'interval_type'  => 'minute',
				'interval_value' => 1
			],
			[
				'title'          => 'Enterprise',
				'level'          => 5,
				'request_limit'  => 500,
				'interval_type'  => 'second',
				'interval_value' => 1
			],
			[
				'title'          => 'Enterprise Plus',
				'level'          => 5,
				'request_limit'  => 5000,
				'interval_type'  => 'second',
				'interval_value' => 1
			],
		];

		$count = AccessLevel::all()->count();

		if(!$count) {

			DB::table('api_access_levels')->delete();

			foreach($seedData as $access)
			{
				$accessLevel = new AccessLevel;
				$accessLevel->level          = $access['level'];
				$accessLevel->title          = $access['title'];
				$accessLevel->request_limit  = $access['request_limit'];
				$accessLevel->interval_type  = $access['interval_type'];
				$accessLevel->interval_value = $access['interval_value'];
				$accessLevel->save();
			}

		}

	}

}
