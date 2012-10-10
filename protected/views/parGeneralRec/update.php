<?php
/* @var $this ParGeneralRecController */
/* @var $model ParGeneralRec */

$this->breadcrumbs=array(
	'Par General Recs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ParGeneralRec', 'url'=>array('index')),
	array('label'=>'Create ParGeneralRec', 'url'=>array('create')),
	array('label'=>'View ParGeneralRec', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ParGeneralRec', 'url'=>array('admin')),
);
?>

<h1>Update ParGeneralRec <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>