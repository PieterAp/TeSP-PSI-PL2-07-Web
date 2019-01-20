<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Categoria */

$this->title = 'Create Category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
