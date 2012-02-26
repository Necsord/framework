<?php

namespace app\controllers;

use app\models\Users;
use app\models\Warnings;

class IndexController extends \lithium\action\Controller {

	public function index() {
		// Clearing collection.
		Users::remove();
		// Adding test user
		$user = Users::create(array('login' => 'randomLogin', 'warnings' => array()));
		$user->save();


		// Condition for searching previously added user.
		$conditions = array(
			'conditions' => array(
				'login' => 'randomLogin'
			)
		);
		$incorrectCycles = array();

		for($i = 0; $i < 500; $i++)
		{
			// Searching for the user.
			$user = Users::find('first', $conditions);
			// Clearing warning field.
			$user->warnings = array();
			// Creating new warning object.
			$warning = array(
				'created' => time(),
				'user_id' => $user->data('_id')
			);
			$warning = Warnings::create($warning);
			// Adding warning object to an empty warning array field.
			$user->warnings[] = $warning;
			$user->save();
			// First check to see if user object has a correct type of `created`.
			// It is always correct
			var_dump('Saving: ' . (($user->data('warnings.0.created') instanceof \MongoDate) ? 'MongoDate' : 'Timestamp'));
			// Searching for the user again. To check if data was correctly written to the MongoDB.
			$user = Users::find('first', $conditions);
			// Should be the same as above.
			var_dump('Saved in db: ' . ( ($user->data('warnings.0.created') instanceof \MongoDate) ? 'MongoDate' : 'Timestamp' ) );

			// Separator between cycles.
			var_dump('===============================');

			if(!$user->data('warnings.0.created') instanceof \MongoDate)
			{
				$incorrectCycles[] += $i;
			}
		}
		var_dump('Iterations when timestamp was saved to the db:');
		foreach($incorrectCycles as $value)
		{
			var_dump($value);
		}
		var_dump('If none were displayed try increasing the iteration count or refresh few times.');
		exit;
	}
}

?>