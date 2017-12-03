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
<?= $form->field($project, 'pname')?>
<?= $form->field($project, 'description')->textarea(['rows' => 3])?>
<?php if($staff): ?>
<?= $form->field($project, 'thestaff')->checkboxList($staff) ?>
<?php endif; ?>
<?= Html::submitButton('Изменить', ['class' => "btn btn-success"]) ?>
<?php ActiveForm::end() ?>