<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php if($employee): ?>
<?php echo 'Вы удалили ' . $employee->name . ' ' . $employee->surname; ?>
<?php else: ?>
<h2>Такого сотрудника нет. </h2>
<?php endif; ?>
