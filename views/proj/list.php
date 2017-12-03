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
    
<?php if($project): ?>   
<h2>Проекты</h2>
<?php else: ?>
<h2>Проектов ещё нет.</h2>
<?php endif; ?>

<?php foreach($project as $pr): ?>
    <pre>
<?= $pr->pname; ?>

<?= Html::a('Просмотреть', Url::to(["/proj/show/$pr->id"])) ?> 
<?= ' ' ?>
<?= Html::a('Редактировать', Url::to(["/proj/edit/$pr->id"])) ?> 
<?= ' ' ?>
<?= Html::a('Удалить', Url::to(["/proj/erase/$pr->id"])) ?>
    </pre>
<?php endforeach; ?>
