<?php


use yii\db\Migration;


class m241109_083604_run_offer_sql_script extends Migration
{
    public function safeUp()
    {
        $sql = file_get_contents(Yii::getAlias('@app') . '/migrations/migrations_offer.sql');
        $this->execute($sql);
    }

    
    public function safeDown()
    {
        $this->dropTable('offers');
    }
}
