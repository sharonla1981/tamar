<?php
/* @var $this ParGeneralNorecController */
/* @var $data ParGeneralNorec */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->param_name), array('view', 'id'=>$data->param_name)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_id')); ?>:</b>
	<?php echo CHtml::encode($data->param_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_value')); ?>:</b>
	<?php echo CHtml::encode($data->param_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	<?php echo CHtml::encode($data->end_date); ?>
	<br />


</div>