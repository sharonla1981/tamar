<?php
/* @var $this ParGeneralRecController */
/* @var $model ParGeneralRec */

$this->breadcrumbs=array(
	'Par General Recs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ParGeneralRec', 'url'=>array('index')),
	array('label'=>'Manage ParGeneralRec', 'url'=>array('admin')),
);
?>

<h1>Create ParGeneralRec</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>