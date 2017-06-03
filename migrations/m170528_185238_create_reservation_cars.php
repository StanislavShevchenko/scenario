<?php

use yii\db\Migration;

class m170528_185238_create_reservation_cars extends Migration
{
    public function up()
    {
		/*CREATE TABLE `scenario_yii`.`reservation_cars` ( `id` INT NOT NULL AUTO_INCREMENT , `car` INT NOT NULL , `mest` TINYINT NOT NULL , `month` TINYINT NOT NULL , `time` VARCHAR(5) NOT NULL , `sdate` VARCHAR(10) NOT NULL , `edate` VARCHAR(10) NOT NULL , `formulr` INT NOT NULL , `user` INT NOT NULL , `created` BIGINT NOT NULL , `sdate_i` BIGINT NOT NULL , `edate_i` BIGINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;*/
		$this->execute("CREATE TABLE `scenario_yii`.`reservation_cars` ( "
				. "`id` INT NOT NULL AUTO_INCREMENT , "
				. "`car` INT NOT NULL , "
				. "`mest` TINYINT NOT NULL , "
				. "`month` TINYINT NOT NULL , "
				. "`time` VARCHAR(5) NOT NULL , "
				. "`sdate` VARCHAR(10) NOT NULL , "
				. "`edate` VARCHAR(10) NOT NULL , "
				. "`formulr` INT NOT NULL , "
				. "`user` INT NOT NULL , "
				. "`created` BIGINT NOT NULL , "
				. "`sdate_i` BIGINT NOT NULL , "
				. "`edate_i` BIGINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;"
		);		
    }

    public function down()
    {
        $this->dropTable('cars');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
