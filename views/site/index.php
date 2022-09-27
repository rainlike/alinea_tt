<?php

use app\searches\Tender as Search;
use yii\bootstrap5\LinkPager;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/**
 * @var ActiveDataProvider $dataProvider
 * @var Search $searchModel
 * @var View $this
 */

$this->title = 'Tenders';
?>
<div class="row">
    <div class="col-12">
        <div class="card p-3 mt-5">
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'pager' => [
                            'class' => LinkPager::class,
                            'options' => [
                                'class' => 'float-right'
                            ],
                            'pageCssClass' => 'page-item',
                            'linkOptions' => [
                                'class' => 'page-link'
                            ]
                        ],
                        'columns' => [
                            ['attribute' => 'id'],
                            ['attribute' => 'tender_id'],
                            [
                                'attribute' => 'amount',
                                'format' => ['decimal', 2]
                            ],
                            [
                                'attribute' => 'date_modified',
                                'format' => 'date'
                            ],
                            ['attribute' => 'description'],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
