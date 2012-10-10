<?php
/* @var $this ParGeneralNorecController */
/* @var $model ParGeneralNorec */

$this->breadcrumbs=array(
	'Par General Norecs'=>array('index'),
	$model->param_name,
);

$this->menu=array(
	array('label'=>'List ParGeneralNorec', 'url'=>array('index')),
	array('label'=>'Create ParGeneralNorec', 'url'=>array('create')),
	array('label'=>'Update ParGeneralNorec', 'url'=>array('update', 'id'=>$model->param_name)),
	array('label'=>'Delete ParGeneralNorec', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->param_name),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ParGeneralNorec', 'url'=>array('admin')),
);
?>

<h1>View ParGeneralNorec #<?php echo $model->param_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'param_name',
		'param_id',
		'param_value',
		'start_date',
		'end_date',
	),
)); ?>
