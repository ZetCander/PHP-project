<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<h1>Введите данные сотрудника</h1>
<?php if( YII::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo YII::$app->session->getFlash('success'); ?>
</div>
<?php endif; ?>

<?php if( YII::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo YII::$app->session->getFlash('error'); ?>
</div>
<?php endif; ?>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($employee, 'name')?>
<?= $form->field($employee, 'surname')?>
<?= $form->field($employee, 'email')?>
<?= $form->field($employee, 'gender')
    ->radioList([
         'мужской' => 'мужской',
        'женский' => 'женский',
    ]); ?>
<?= $form->field($employee, 'age')?>
<?= $form->field($employee, 'efficiency')?>
<?= $form->field($employee, 'salary')?>
<?= $form->field($employee, 'qualification')
    ->radioList([
        'Начальное профессиональное образование' => 'Начальное профессиональное образование',
        'Среднее профессиональное образование' => 'Среднее профессиональное образование',
        'Бакалавр' => 'Бакалавр',
        'Специалист' => 'Специалист',
        'Магистр' => 'Магистр',
        'Другое' => 'Другое',
    ]); ?>
<?= $form->field($employee, 'experience')?>
<?php if($projects): ?>
<?= $form->field($employee, 'projects')->checkboxList($projects) ?>
<?php endif; ?>
<?= Html::submitButton('Добавить', ['class' => "btn btn-success"]) ?>
<?php ActiveForm::end() ?>