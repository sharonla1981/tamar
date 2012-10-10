<?php
/* @var $this ParGeneralNorecController */
/* @var $model ParGeneralNorec */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'par-general-norec-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'param_name'); ?>
		<?php echo $form->textField($model,'param_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'param_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'param_id'); ?>
		<?php echo $form->textField($model,'param_id'); ?>
		<?php echo $form->error($model,'param_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'param_value'); ?>
		<?php echo $form->textField($model,'param_value',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'param_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?php echo $form->textField($model,'end_date'); ?>
		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->