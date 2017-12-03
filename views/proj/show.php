<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h3>
<?= 'Название проекта: ' . $project['pname'];  ?> <br/>

Описание проекта: <br/>
<?= $project['description'];?> <br/><br/>


Участники проекта:
<?php foreach($project['staff'] as $ps): ?> <br/>
    <?= Html::a("{$ps['name']} {$ps['surname']}", Url::to(["/staff/show/{$ps['id']}"])) ?>
<?php endforeach; ?>
</h3>