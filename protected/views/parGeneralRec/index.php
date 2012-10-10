<?php
/* @var $this ParGeneralRecController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Par General Recs',
);

$this->menu=array(
	array('label'=>'Create ParGeneralRec', 'url'=>array('create')),
	array('label'=>'Manage ParGeneralRec', 'url'=>array('admin')),
);
?>

<h1>Par General Recs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
