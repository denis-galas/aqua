<?php
namespace Fuel\Migrations;
use Model_Admin;

class Admins_create
{

	function up()
	{
		if(!\DBUtil::table_exists('admins')) {
			\DBUtil::create_table(
					'admins',
					array(
							'id' => array('constraint' => 10, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
							'firstname' => array('constraint' => 32, 'type' => 'varchar'),
							'lastname' => array('constraint' => 32, 'type' => 'varchar'),
							'username' => array('constraint' => 32, 'type' => 'varchar'),
							'email' => array('constraint' => 80, 'type' => 'varchar'),
							'password' => array('constraint' => 32, 'type' => 'varchar'),
							'salt' => array('constraint' => 28, 'type' => 'varchar'),
							'last_login' => array('type' => 'varchar', 'constraint' => 25, 'null' => true),
							'login_hash' => array('type' => 'varchar', 'constraint' => 255, 'null' => true),
					),
					array('id'), false, 'InnoDB', 'utf8_general_ci'
			);

			$admin = new Model_Admin();
			$admin->firstname = 'admin';
			$admin->lastname = 'admin';
			$admin->username = 'admin';
			$admin->email = '';
			$admin->password = 'Admin$Pass';
			$admin->save();
		}
	}

	function down()
	{
		if(\DBUtil::table_exists('admins')) {
			\DBUtil::drop_table('admins');
		}
	}
}