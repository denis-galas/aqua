<?php


class Model_Admin extends Orm\Model
{
	protected static $_table_name = 'admins';
	protected static $_primary_key = array('id');
	protected static $_properties = array (
			'id', 'firstname', 'lastname', 'username', 'email', 'password', 'salt',
			);
	protected static $_observers = array('Orm\\Observer_GenerateSaltAndPassword' => array(
			'events' => array('before_insert')
	));

	/**
	 * this function creates record for new admin
	 *
	 * @return Model_Hbadmin
	 */
	public static function register() {
		$user = new Model_Admin();
		$user->firstname = Input::post('firstname');
		$user->lastname = Input::post('lastname');
		$user->username = Input::post('email');
		$user->email = Input::post('email');
		$user->password = Input::post('password');
		$user->offset = Input::post('offset');
	
		$user->save();
	
		return $user;
	}
	
	/**
	 * this function retrieve user object by given field
	 */
	public static function getRecord($field, $value)
	{
		$query = self::query()->where($field, $value);
	
		return $query->get_one();
	}
	
	/**
	 * this function check if same record with already exists in entered field
	 */
	public static function isRecordExists($field, $value)
	{
		$query = self::query()->where($field, $value);
	
		return (bool) $query->count();
	}
	
	/**
	 * This function check login and password of user
	 * If wrong then returns error message
	 * else returns user object
	 *
	 * @param string $username
	 * @param string $password
	 * @return string|Model_Hbadmin
	 */
	public static function checkIfLoginValid($username, $password) {
		$user = self::getRecord('username', $username);
		if (!$user) {
			return 'Админ с таким логином не существует!';
		}
	
		$hash_pass = md5($user->salt.$password);
		if ($hash_pass != $user->password) {
			return 'Комбинация логина и пароля ошибочна!';
		}
	
		return $user;
	}
}
