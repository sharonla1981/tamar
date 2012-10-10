<?php
/* @var $this ParGeneralRecController */
/* @var $model ParGeneralRec */

$this->breadcrumbs=array(
	'Par General Recs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ParGeneralRec', 'url'=>array('index')),
	array('label'=>'Create ParGeneralRec', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('par-general-rec-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Par General Recs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'par-general-rec-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'param_name',
		'param_id',
		'sub_param_name',
		'sub_param_id',
		'param_value',
		'start_date',
		/*
		'end_date',
		'id',
		'param_heb_name',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
