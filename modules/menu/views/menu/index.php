<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Search\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Items';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="menu-index">

<!--    <h1>--><?php //= Html::encode($this->title) ?><!--</h1>-->

    <p class="text-right">
        <?= Html::a('Add Menu Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => [
                    'width' => '5%'
                ],
            ],
            'name',
            'url:url',
            [
                'attribute' => 'parent',
                'headerOptions' => [
                    'width' => '10%'
                ],
            ],
                [
                    'attribute' => 'isgroup',
                    'headerOptions' => [
                        'width' => '10%',
                    ],
                    'contentOptions' => [
                        'text-align' => 'center',
                    ],
                ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;{delete}',
                'headerOptions' => [
                    'width' => '50px',
                    'text-align' => 'center',
                ],
                'buttons' => [
                    'delete' => function ($url,$model,$key){
                        if( $model->countChild > 0 ){
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                                [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'aria-label' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Category not empty, are you sure you want to delete this category?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]
                            );
                        } else {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                                [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'aria-label' => Yii::t('yii', 'Delete'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]
                            );
                        }
                    }
                 ],
            ],
        ],
        'pager' => [
            'firstPageLabel'=>'<<',
            'prevPageLabel'=>'<',
            'nextPageLabel'=>'>',
            'lastPageLabel'=>'>>',
            'maxButtonCount'=>'9',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
