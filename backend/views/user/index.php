<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        'username',
        //'auth_key',
        ['attribute'=>'password_hash','label'=>'Password'],
        //'password_reset_token',
        'email',
        //'user_role.role_id',
        [
            'attribute' => 'role',
            'value' => function($data) {
                if (isset($data->user_role->role_desc)) {
                    return $data->user_role->role_desc;
                } else {
                    return 'ไม่ทราบสิทธิ'; //
                }
            },
            'filter' => \yii\helpers\ArrayHelper::map(backend\models\UserRole::find()->all(), 'role_name', 'role_desc'),
        ],
        // 'status',
        'created_at',
        'updated_at',
        ['class' => 'yii\grid\ActionColumn']
    ];
    echo kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'pjaxSettings' => [
            //'neverTimeout' => true,
            'options' => [
                'enablePushState' => false,
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'before' => '',
        //'after'=>''
        ],
        'columns' => $columns
    ]);
    ?>

</div>
