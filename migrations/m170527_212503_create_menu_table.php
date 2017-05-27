<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m170527_212503_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'url' => $this->string(256),
            'parent' => $this->integer(),
            'isgroup' => $this->boolean(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
