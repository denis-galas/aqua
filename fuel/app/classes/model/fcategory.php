<?php


class Model_Fcategory extends Orm\Model
{
	protected static $_table_name = 'fish_categories';
	protected static $_primary_key = array('id');
	protected static $_properties = array (
			'id', 'title', 'description'
			);
	protected static $_has_many = array(
			'fcategory' => array(
					'key_from' => 'id',
					'model_to' => 'Model_Gallery',
					'key_to' => 'category',
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
	
	public static function returnArray($empty = false)
	{
		$categories = self::find('all');
		
		$cat_arr = array();
		if ($empty) {
			$cat_arr['all'] = 'Все категории';
		}
		foreach ($categories as $category) {
			$cat_arr[$category->id] = $category->title;  
		}
		
		return $cat_arr;
	} 
}
