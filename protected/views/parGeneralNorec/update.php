<?php
/* @var $this ParGeneralNorecController */
/* @var $model ParGeneralNorec */

$this->breadcrumbs=array(
	'Par General Norecs'=>array('index'),
	$model->param_name=>array('view','id'=>$model->param_name),
	'Update',
);

$this->menu=array(
	array('label'=>'List ParGeneralNorec', 'url'=>array('index')),
	array('label'=>'Create ParGeneralNorec', 'url'=>array('create')),
	array('label'=>'View ParGeneralNorec', 'url'=>array('view', 'id'=>$model->param_name)),
	array('label'=>'Manage ParGeneralNorec', 'url'=>array('admin')),
);
?>

<h1>Update ParGeneralNorec <?php echo $model->param_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>