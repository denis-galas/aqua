<?php
namespace Fuel\Migrations;

class News_create
{

	function up()
	{
		if(!\DBUtil::table_exists('news')) {
			\DBUtil::create_table(
					'news',
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
		if(\DBUtil::table_exists('news')) {
			\DBUtil::drop_table('news');
		}
	}
}