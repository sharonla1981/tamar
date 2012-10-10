<?php
/* @var $this ParGeneralNorecController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Par General Norecs',
);

$this->menu=array(
	array('label'=>'Create ParGeneralNorec', 'url'=>array('create')),
	array('label'=>'Manage ParGeneralNorec', 'url'=>array('admin')),
);
?>

<h1>Par General Norecs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
