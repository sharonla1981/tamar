<?php
/* @var $this ParGeneralNorecController */
/* @var $model ParGeneralNorec */

$this->breadcrumbs=array(
	'Par General Norecs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ParGeneralNorec', 'url'=>array('index')),
	array('label'=>'Manage ParGeneralNorec', 'url'=>array('admin')),
);
?>

<h1>Create ParGeneralNorec</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>