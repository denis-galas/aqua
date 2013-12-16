<?php
namespace Fuel\Migrations;

class Gallery_create
{

	function up()
	{
		if(!\DBUtil::table_exists('gallery')) {
			\DBUtil::create_table(
					'gallery',
					array(
							'id' => array('constraint' => 10, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
							'title' => array('constraint' => 255, 'type' => 'varchar'),
							'category' => array('type' => 'int'),
							'source' => array('constraint' => 255, 'type' => 'varchar'),
					),
					array('id'), false, 'InnoDB', 'utf8_general_ci'
			);
		}
	}

	function down()
	{
		if(\DBUtil::table_exists('gallery')) {
			\DBUtil::drop_table('gallery');
		}
	}
}