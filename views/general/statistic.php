<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php if($stat['total'][0]['snumb']): ?>
<h2>Статистика следующая:</h2>
<h3>
Количество сотрудников компании:
<?php
echo $stat['total'][0]['snumb'] . ' человек.';
?> <br/>

Ежемесячные выплаты сотрудникам:
<?php
echo $stat['total'][0]['sum'] . ' рублей.';
?> <br/>

Средняя заработная плата:
<?php
echo $stat['total'][0]['avg'] . ' рублей.';
?> <br/>

Максимальная заработная плата у
<?= Html::a("{$stat['maxsal'][0]['name']} {$stat['maxsal'][0]['surname']}",
            Url::to(["/staff/show/{$stat['maxsal'][0]['id']}"])) . ', ' ?>
<?= $stat['maxsal'][0]['salary'] . ' рублей.' ?> <br/>

Минимальная заработная плата у
<?= Html::a("{$stat['minsal'][0]['name']} {$stat['minsal'][0]['surname']}",
            Url::to(["/staff/show/{$stat['minsal'][0]['id']}"])) . ', ' ?>
<?= $stat['minsal'][0]['salary'] . ' рублей.' ?> <br/>

Количество мужчин:
<?php
echo (int)$stat['snumber'][1]['cgen'] . ' человек.';
?> <br/>
Количество женщин:
<?php
echo (int)$stat['snumber'][0]['cgen'] . ' человек.';
?> 

<?php foreach ($stat['qual'] as $st): ?> <br/>
Указали квалификацию
<?= '"'.$st['qualification'] . '" ' . $st['cqual'] . ' человек.' ;?>
<?php endforeach; ?> 

<?php foreach ($stat['staffproj'] as $st): ?> <br/>
<?= Html::a("{$st['name']} {$st['surname']}",
            Url::to(["/staff/show/{$st['id']}"])) . ' ' ?>
участвует в 
<?= $st['pCount'] . ' проектах.'; ?>
<?php endforeach; ?> 
</h3>
<?php else: ?>
<h3>В компании ещё нет сотрудников.<h3/>
<?php endif; ?>
