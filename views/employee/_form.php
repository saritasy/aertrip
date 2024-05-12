<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department_id')->textInput() ?>

    <?= $form->field($model, 'employee_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_email')->textInput(['maxlength' => true]) ?>

    <!-- Address Fields -->
    <?= $form->field($model, 'addresses[0][address_line_1]')->textInput(['maxlength' => true])->label('Address Line 1') ?>
    <?= $form->field($model, 'addresses[0][address_line_2]')->textInput(['maxlength' => true])->label('Address Line 2') ?>
    <?= $form->field($model, 'addresses[0][city]')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'addresses[0][state]')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'addresses[0][country]')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'addresses[0][postal_code]')->textInput(['maxlength' => true]) ?>

    <!-- Contact Number Fields -->
    <?= $form->field($model, 'contactNumbers[0][contact_number]')->textInput(['maxlength' => true])->label('Contact Number') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
