<?php

$model = $this->paramScreenPanel();

foreach ($model as $param)
{
	echo CHtml::link($param->getAttribute('param_heb_name'),'index.php?r=parGeneralRec/paramScreen&param_name='.$param->getAttribute('param_name'));
	echo "<br />";
} 



?>