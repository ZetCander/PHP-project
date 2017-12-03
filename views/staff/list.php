<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<style type="text/css">
    pre {
        background: #fffafa;
        font-size: 150%;
    }
    </style>
    
<?php if($staff): ?>   
<h2>Сотрудники</h2>
<?php else: ?>
<h2>У вас еще нет сотрудников.</h2>
<?php endif; ?>

<?php foreach($staff as $st): ?>
    <pre>
<?=$st->surname . ' ' . $st->name; ?>

<?= 'Email: ' . $st->email; ?>

<?= 'Эффективность ' . $st->efficiency . '%' ;?>

<?= Html::a('Просмотреть', Url::to(["staff/show/$st->id"])) ?> 
<?= ' ' ?>
<?= Html::a('Редактировать', Url::to(["staff/edit/$st->id"])) ?> 
<?= ' ' ?>
<?= Html::a('Удалить', Url::to(["staff/erase/$st->id"])) ?>
    </pre>
<?php endforeach; ?>
