<?php

use yii\db\Migration;

class m170528_185238_alter_table_users extends Migration
{
    public function up()
    {
		$this->execute("ALTER TABLE `users` ADD"
				. " `mphone` VARCHAR(50) NULL AFTER `role`, ADD "
				. " `key` VARCHAR(50) NULL COMMENT 'ключ' AFTER `mphone`, ADD"
				. " `rangs` VARCHAR(50) NULL COMMENT 'Звания' AFTER `key`, ADD"
				. " `city` VARCHAR(100) NULL AFTER `rangs`, ADD"
				. " `street` VARCHAR(100) NULL AFTER `city`, ADD"
				. " `home` VARCHAR(50) NULL AFTER `street`, ADD"
				. " `zip` VARCHAR(50) NULL AFTER `home`, ADD"
				. " `country` VARCHAR(100) NULL AFTER `zip`, ADD"
				. " `personal_num` VARCHAR(100) NULL COMMENT 'персанальный номер' AFTER `country`, ADD"
				. " `start_work` VARCHAR(50) NULL AFTER `personal_num`, ADD"
				. " `end_work` VARCHAR(50) NULL AFTER `start_work`, ADD"
				. " `department` ENUM('chief','subordinate','','') NULL AFTER `end_work`, ADD"
				. " `second_rangs` VARCHAR(50) NULL AFTER `department`"
		);		
    }

    public function down()
    {
        echo "m170528_185238_alter_table_users cannot be reverted.\n";

        return false;
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
