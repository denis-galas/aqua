<?php
namespace Fuel\Migrations;

class Slides_create
{

	function up()
	{
		if(!\DBUtil::table_exists('slides')) {
			\DBUtil::create_table(
					'slides',
					array(
							'id' => array('constraint' => 10, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
							'title' => array('constraint' => 255, 'type' => 'varchar'),
							'description' => array('type' => 'text'),
							'source' => array('constraint' => 255, 'type' => 'varchar'),
					),
					array('id'), false, 'InnoDB', 'utf8_general_ci'
			);
		}
	}

	function down()
	{
		if(\DBUtil::table_exists('slides')) {
			\DBUtil::drop_table('slides');
		}
	}
}