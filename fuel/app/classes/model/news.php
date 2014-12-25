<?php


class Model_News extends Orm\Model
{
	protected static $_table_name = 'news';
	protected static $_primary_key = array('id');
	protected static $_properties = array (
			'id', 'title', 'description', 'source',
			'on_main' => array(
					'data_type' => 'int',
					'default' => 0
			),
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
	
	public static function getAll($main = false)
	{
		$on_main = $main ? 1 : 0;
		$query = self::query()
		->where('on_main', $on_main)
		->order_by('id', 'DESC');
		
		return $query->get();
	}
}
