<?php
namespace Fuel\Migrations;

class News_main
{
	function up()
	{
		if(!\DBUtil::field_exists('news', array('on_main'))) {
			\DBUtil::add_fields('news', array(
					'on_main' => array('constraint' => 1, 'type' => 'int', 'default' => 0),
			));
		}
	}

	function down()
	{
		if(\DBUtil::field_exists('news', array('on_main'))) {
			\DBUtil::drop_fields('news', array('on_main'));
		}
	}
}