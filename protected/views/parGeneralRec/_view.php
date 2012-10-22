<?php
/* @var $this ParGeneralRecController */
/* @var $data ParGeneralRec */
?>

<div class="view">
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_name')); ?>:</b>
	<?php echo CHtml::encode($data->param_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_id')); ?>:</b>
	<?php echo CHtml::encode($data->param_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_param_name')); ?>:</b>
	<?php echo CHtml::encode($data->sub_param_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_param_id')); ?>:</b>
	<?php echo CHtml::encode($data->sub_param_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_value')); ?>:</b>
	<?php echo CHtml::encode($data->param_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	<?php echo CHtml::encode($data->end_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param_heb_name')); ?>:</b>
	<?php echo CHtml::encode($data->param_heb_name); ?>
	<br />

	*/ ?>

</div>