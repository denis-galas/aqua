<?php
namespace Fuel\Migrations;

class Fish_categories_create
{

	function up()
	{
		if(!\DBUtil::table_exists('fish_categories')) {
			\DBUtil::create_table(
					'fish_categories',
					array(
							'id' => array('constraint' => 10, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
							'title' => array('constraint' => 255, 'type' => 'varchar'),
							'description' => array('type' => 'text'),
					),
					array('id'), false, 'InnoDB', 'utf8_general_ci'
			);
		}
	}

	function down()
	{
		if(\DBUtil::table_exists('fish_categories')) {
			\DBUtil::drop_table('fish_categories');
		}
	}
}