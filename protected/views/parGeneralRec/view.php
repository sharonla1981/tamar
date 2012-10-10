<?php
/* @var $this ParGeneralRecController */
/* @var $model ParGeneralRec */

$this->breadcrumbs=array(
	'Par General Recs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ParGeneralRec', 'url'=>array('index')),
	array('label'=>'Create ParGeneralRec', 'url'=>array('create')),
	array('label'=>'Update ParGeneralRec', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ParGeneralRec', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ParGeneralRec', 'url'=>array('admin')),
);
?>

<h1>View ParGeneralRec #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'param_name',
		'param_id',
		'sub_param_name',
		'sub_param_id',
		'param_value',
		'start_date',
		'end_date',
		'id',
		'param_heb_name',
	),
)); ?>
