<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h3>
<?= 'Имя: ' . $employee['name'];  ?> <br/>
<?= "Фамилия: " . $employee['surname'];?> <br/>
<?= "Email: " . $employee['email'];?> <br/>
<?= "Возраст: " . $employee['age'] . ' лет';?> <br/>
<?= "Пол: " . $employee['gender'];?> <br/>
<?= "Эффективность: " . $employee['efficiency'] . '%';?> <br/>
<?= "Заработная плата: " . $employee['salary'] . ' рублей';?> <br/>
<?= "Квалификация: " . $employee['qualification'];?> <br/>
<?= "Опыт работы: " . $employee['experience'] . ' лет';?> <br/>

Проекты:
<?php if($employee['project']): ?>
<?php foreach($employee['project'] as $ep): ?> <br/>
    <?= Html::a("{$ep['pname']}", Url::to(["/proj/show/{$ep['id']}"])) ?> 
<?php endforeach;?>
<?php else: ?> <br/>
Пока что не участвует ни в одном проекте.
<?php endif; ?>
</h3>