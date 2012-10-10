<?php
/* @var $this ParGeneralRecController */
/* @var $model ParGeneralRec */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'param_name'); ?>
		<?php echo $form->textField($model,'param_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'param_id'); ?>
		<?php echo $form->textField($model,'param_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sub_param_name'); ?>
		<?php echo $form->textField($model,'sub_param_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sub_param_id'); ?>
		<?php echo $form->textField($model,'sub_param_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'param_value'); ?>
		<?php echo $form->textField($model,'param_value',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_date'); ?>
		<?php echo $form->textField($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'param_heb_name'); ?>
		<?php echo $form->textField($model,'param_heb_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->