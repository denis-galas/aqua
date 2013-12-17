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
	protected static $_belongs_to = array(
			'fcategory' => array(
					'key_from' => 'category',
					'model_to' => 'Model_Fcategory',
					'key_to' => 'id',
        			'cascade_delete' => false,
			)
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
	
	public static function removeByCategory($category)
	{
		self::query()->where('category', $category)->delete();
	}
	
	public static function getBySort($sort = 'all')
	{
		if ($sort == 'all') {
			return self::find('all', array('related' => array('fcategory')));
		} else {
			return self::query()->related('fcategory')->where('category', $sort)->get();
		}
	}
}
