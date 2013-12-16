<?php

class Model_Gallery extends Orm\Model
{
	protected static $_table_name = 'gallery';
	protected static $_primary_key = array('id');
	protected static $_properties = array (
			'id', 'title', 
			'category' => array(
				'data_type' => 'int',
			)
			, 'source'
			);

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
}
