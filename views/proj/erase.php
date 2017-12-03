<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<h3>
<?php if($project): ?>
<?php echo 'Вы удалили ' . $project->pname; ?>
<?php else: ?>
<h2>Такого проекта нет. </h2>
<?php endif; ?>
</h3>
