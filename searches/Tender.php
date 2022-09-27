<?php

namespace app\searches;

use app\entities\Tender as Entity;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class Tender extends Model
{
    public function search(array $params): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Entity::find()->orderBy(['id' => SORT_DESC])
        ]);
    }
}
