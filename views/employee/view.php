<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = $model->employee_id;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'employee_id' => $model->employee_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'employee_id' => $model->employee_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'employee_id',
            'department_id',
            'department.department_name',
            'employee_name',
            'employee_email:email',

        ],
    ]) ?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => 'Addresses',
            'value' => function ($model) {
                $addresses = '';
                foreach ($model->addresses as $address) {
                    $addresses .= $address->address_line_1 . ', ' . $address->city . ', ' . $address->state . '<br>';
                }
                return $addresses;
            },
            'format' => 'html',
        ],
        [
            'label' => 'Contact Numbers',
            'value' => function ($model) {
                $contactNumbers = '';
                foreach ($model->contactNumbers as $contactNumber) {
                    $contactNumbers .= $contactNumber->contact_number . '<br>';
                }
                return $contactNumbers;
            },
            'format' => 'html',
        ],
    ],
]) ?>


</div>
