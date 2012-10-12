<?php       

//the data array of the data provider
$dataP = $dataProvider->getData();

$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'paramView',
				'dataProvider'=>$dataProvider,
				'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridView.css'),
                'cssFile' => Yii::app()->baseUrl . '/css/gridView.css',
		        'htmlOptions' => array('class' => 'grid-view rounded','direction'=>'rtl'),
				'columns'=>array(
							array(
									//the type is raw so the title can be generated from another data source
									'type'=>'raw',
									'name'=>$dataP[0]['paramName'],
									'value'=>'$data["value"]'
									),
							array(
									'type'=>'raw',
									'name'=>$dataP[0]['subParamName'],
									'value'=>'$data["subValue"]'
									),
						),
			));
			
?>