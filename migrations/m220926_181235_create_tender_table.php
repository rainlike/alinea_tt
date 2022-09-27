<?php

use yii\db\Migration;

class m220926_181235_create_tender_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tender', [
            'id' => $this->primaryKey(),
            'tender_id' => $this->string(255)->notNull(),
            'description' => $this->text()->null()->defaultValue(null),
            'amount' => $this->decimal(15, 4)->notNull(),
            'date_modified' => $this->dateTime()->notNull(),
        ]);

        $this->createTable('log', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull(),
            'url' => $this->string(255)->notNull(),
            'message' => $this->string(255)->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tender');
        $this->dropTable('log');
    }
}
