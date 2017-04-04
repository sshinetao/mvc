<?php

namespace App\Home\Models;


use Medoo\Medoo;
class User extends \Core\Model {

	/**
	 * Get all the users as an associative array
	 *
	 * @return array
	 */
    public function getUser(){
        $account = new Medoo();

        return $account;
    }

}
