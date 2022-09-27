<?php

namespace app\entities;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $status
 * @property string $url
 * @property string|null $message
 */
class Log extends ActiveRecord
{
    public const STATUS_INFO = 1;
    public const STATUS_ERROR = 2;

    /** {@inheritdoc} */
    public static function tableName(): string
    {
        return 'log';
    }

    public function rules(): array
    {
        return [
            [['status', 'url', 'message'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'url' => 'URL',
            'message' => 'Message',
        ];
    }
}
