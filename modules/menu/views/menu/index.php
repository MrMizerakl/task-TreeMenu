<?php

use yii\bootstrap\Modal;
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
        <?= Html::a(
            'Add Menu Item',
            ['create'],
            [
                'id' => 'tree-menu-btn-add',
                'class' => 'btn btn-success',
                'data' => [
                    'target' => '#w0',
                    'toggle' => 'modal',
                    'backdrop' => 'static',
                ],
            ]) ?>
    </p>
<?php Modal::begin([
    'header' => '<span></span>',
]); ?>
    <div id="tree-menu-edit-data"></div>
<?php Modal::end(); ?>
<?php Pjax::begin(['id'=>'tree-menu-table']); ?>
    <?= GridView::widget([
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
                'contentOptions' => [
                    'align' => 'center',
                ],
            ],
                [
                    'attribute' => 'isgroup',
                    'headerOptions' => [
                        'width' => '10%',
                    ],
                    'contentOptions' => [
                        'align' => 'center',
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
                    'update' => function ($url,$model,$key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            $url,
                            [
                                'title' => 'Update',
                                'data' => [
                                    'target' => '#w0',
                                    'toggle' => 'modal',
                                    'backdrop' => 'static',
                                ],
                            ]
                        );
                    },
                    'delete' => function ($url,$model,$key){

                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            '#',
                            [
                                'title' => 'Delete',
                                'aria-label' => 'Delete',
                                'onclick' => "
if (confirm('Category not empty, are you sure you want to delete this category?')) {
    $.ajax('". $url. "', {
        type: 'POST'
    }).done(function(data) {
        $.pjax.reload({container: '#tree-menu-table'});
    });
}
return false;",
                            ]
                        );
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

<?php

$js = <<<JS
jQuery('body').on('click', 'a[href*="update"]', function(e){
   
    jQuery.ajax({
        url: this,                             
        dataType : 'html',                     
        success: function (data) {
            jQuery('.modal-header span').html( 'Update item menu' );
            jQuery('#tree-menu-edit-data').html(data);
        },
        error: function (data) {
            console.log('error load Ajax');
        }
    });
}); 

jQuery('body').on('click', 'a[href*="create"]', function(e){   

    jQuery.ajax({
        url: this,                             
        dataType : 'html',                     
        success: function (data) {
            jQuery('.modal-header span').html( 'Create new item menu' );
            jQuery('#tree-menu-edit-data').html(data);
        },
        error: function (data) {
            console.log('error load Ajax');
        }
    });
});

 jQuery('body').on('click','#tree-menu-btn-submit',function(e){
    e.preventDefault();
    var form = jQuery(this).closest('form');
    jQuery.post(
        form.attr("action"),
        form.serialize()
    )
    .success(function(result) {
        if ( result.success == 'formSave' ) {
            jQuery('#edict-edit-child').html( 'Item save' );
            jQuery.pjax.reload( {container: '#tree-menu-table' } );
            setTimeout( function() { 
                jQuery('#w0').modal('hide');
                }, 500);
        } else {
         jQuery.each(result, function(key, val) {
            form.yiiActiveForm('updateAttribute', key, [val]);
          });
        }  
    })
    .error(function(){
        jQuery('#edict-edit-child').html( 'Error' );
        setTimeout( function() { 
            jQuery('#w0').modal('hide');
            }, 1000);
    })
    ;
    // return false;
}); 

JS;

$this->registerJs($js);
