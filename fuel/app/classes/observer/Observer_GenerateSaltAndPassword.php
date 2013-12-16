<?php

namespace Orm;

/**
 * Observer for generating salt for new admins
 * and hashing password based on new salt and password string
 */
class Observer_GenerateSaltAndPassword extends Observer
{

	/**
	 * Executes only one time before first insert of record
	 * 
	 * @param Model $object
	 */
	public function before_insert(Model $object)
	{
		$object->salt = $this->generateSalt();
		if ($object->password) {
			$object->password = $this->hashPassword($object->password, $object->salt);
		} 
	}
	
	/**
	 * This function generates an alpha-numeric password salt
	 * HOTELbeat uses a 20 character salt. The salt is tacked onto the front of the passwords during
	 * the validation step. salt+pass = a verified user.
	 * @param int $max
	 */
	private function generateSalt($max = 20) {
		$baseStr = time() . rand(0, 1000000) . rand(0, 1000000);
		$md5Hash = md5($baseStr);
		$md5Hash = substr($md5Hash, 0, $max);
		return $md5Hash;
	}

	/**
	 * This function create hash from given salt + password
	 * @param string $pass
	 * @param string $salt
	 * @return string
	 */
	private function hashPassword($pass, $salt) {
		return md5($salt.$pass);
	}
	
}