<?php

namespace app\entities;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $tender_id
 * @property string $description
 * @property float $amount
 * @property \DateTime $date_modified
 */
class Tender extends ActiveRecord
{
    /** {@inheritdoc} */
    public static function tableName(): string
    {
        return 'tender';
    }

    public function rules(): array
    {
        return [
            [['tender_id', 'description', 'amount', 'date_modified'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'tenderId' => 'Tender Id',
            'description' => 'Description',
            'amount' => 'Amount',
            'dateModified' => 'Date Modified',
        ];
    }
}
