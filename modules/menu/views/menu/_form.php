<?php

use app\models\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin([
        'id' => 'edict-form-data',
        'enableClientValidation' => true,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')->dropDownList( ArrayHelper::map(Menu::find()->select(["id", "concat(id, ' - ', name,  IFNULL( concat(' (parent:', parent ,' )'), '') ) as name"])->where(['isgroup'=>1])->asArray()->all(), 'id', 'name'), ['prompt'=>''] ) ?>

    <?= $form->field($model, 'isgroup')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id'=>'tree-menu-btn-submit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
