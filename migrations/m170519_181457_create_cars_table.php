<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cars`.
 */
class m170519_181457_create_cars_table extends Migration
{
    /**
     * @inheritdoc
	 * Номер:
Марка:
Модель:
Топливо:
Год выпуска:
Литраж:
Мест:
Ведущее реле:
Цвет:
Резина:
Расход то-ва:
Киллометраж:
     */
    public function up()
    {
        $this->execute("CREATE TABLE `cars` ("
			. " `id` INT NOT NULL AUTO_INCREMENT , "
			. "`number` VARCHAR(50) NOT NULL COMMENT 'Номер' , "
			. "`brand` VARCHAR(50) NOT NULL COMMENT 'Бренд' , "
			. "`model` VARCHAR(50) NOT NULL COMMENT 'Модель' , "
			. "`fuel` ENUM('бензин','дизель','','') NOT NULL COMMENT 'вид топливо' , "
			. "`year` SMALLINT  COMMENT 'год выпуска' , "
			. "`liters` SMALLINT  COMMENT 'обьем двигателя' ,"
			. " `seats` TINYINT NOT NULL COMMENT 'посадочных мест' , "
			. "`relay` ENUM('задний','передний','полный привод','') COMMENT 'привод' ,"
			. " `color` VARCHAR(50) COMMENT 'цвет' , "
			. "`rubber` VARCHAR(50) COMMENT 'резина' , "
			. "`consumption` TINYINT COMMENT 'расход' , "
			. "`kilometers` MEDIUMINT  COMMENT 'пробег' ,"
			. "`user` INT NOT NULL COMMENT 'кто создал/редактировал' , "
			. "`date_edit` INT NOT NULL COMMENT 'время последней редакции' , "
			. "PRIMARY KEY (`id`), UNIQUE `number_i` (`number`)) ENGINE = InnoDB;"
		);		
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cars');
    }
}
