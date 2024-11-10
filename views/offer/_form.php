<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Offer $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="offer-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false, 
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'required' => true, 'placeholder' => 'Введите название оффера']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email', 'required' => true, 'placeholder' => 'Введите email']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'pattern' => '\+?\d{1,15}', 'minlength' => 10, 'maxlength' => 18, 'placeholder' => 'Введите номер телефона']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
