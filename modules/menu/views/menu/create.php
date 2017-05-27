<?php

//use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Menu */

//$this->title = 'Create Menu Item';
//$this->params['breadcrumbs'][] = ['label' => 'Menu Items', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

<!--    <h1>--><?php //= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
