<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m170511_180423_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
		$this->execute("CREATE TABLE `scenario_yii`.`users` ( "
			. "`id` INT NOT NULL AUTO_INCREMENT , "
			. "`login` VARCHAR(250) NOT NULL , "
			. "`password` VARCHAR(250) NOT NULL , "
			. "`name` VARCHAR(250) NOT NULL , "
			. "`second_name` VARCHAR(250) NULL , "
			. "`last_name` VARCHAR(250) NULL , "
			. "`email` VARCHAR(250) NULL , "
			. "`phone` VARCHAR(250) NULL ,"
			. "`position` VARCHAR(250) NULL ,"
			. "`created`  INT NOT NULL, "
			. "`modified` INT NOT NULL, "
			. "`role` TINYINT NOT NULL DEFAULT '0' , "
			. "PRIMARY KEY (`id`), UNIQUE `login_index` (`login`)) ENGINE = InnoDB;"
		);	
      
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
