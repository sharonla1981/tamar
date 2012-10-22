<?php       

//the data array of the data provider
$dataP = $dataProvider->getData();
$level2data = $level2dataProvider->getData();
$level3data = $level3dataProvider->getData();

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
									'name'=>$dataP[0]['lev1Title'],
									'value'=>'$data["lev1Val"]',
                                                                        
									),
							array(
									'type'=>'raw',
									'name'=>$dataP[0]['lev2Title'],
									'value'=>'$data["lev2Val"]',
                                                                        'htmlOptions'=>array('class'=>'droptrue','name'=>$dataP[0]["lev2Id"],'level'=>'2')
									),
                                                        array(
									'type'=>'raw',
									'name'=>$dataP[0]['lev3Title'],
									'value'=>'$data["lev3Val"]',
                                                                        'htmlOptions'=>array('class'=>'droptrue','name'=>$dataP[0]["lev3Id"],'level'=>'3')
									),
						),
			));
			
?>

<style>
    #sortable1, #sortable2, #sortable3 { list-style-type: none; margin: 0; padding: 0; float: right; margin-right: 10px; background: #eee; padding: 5px; width: 143px;}
    #sortable1 li, #sortable2 li, #sortable3 li { margin: 5px; padding: 5px; font-size: 1.2em; width: 120px; text-align: right}
</style>

<script type="text/javascript">
    $(function() {
        $("ul.droptrue").sortable({
            connetWith: "td"
        });
        
        $("td.droptrue").droppable({
            drop: function(){
                alert($(this).attr('name'));
            }
        })
    });
</script>
<br />
<hr>
<div id="paramLevel2" style="border: 1px;border-color: black;float: right;" level="2">
    <h4>
    <?php echo $level2data[0]['param_heb_name']; ?>
        </h4>
    <ul id="sortable1" class="droptrue">
        <?php
            foreach ($level2data as $param)
            {
                Yii::app()->controller->renderPartial('_paramRow',
                        array('id'=>$param['param_id'],'name'=>$param['param_value'],'widget'=>$this)
                        );
            }
        ?>
    </ul>
</div>

<div id="paramLevel3" level="3">
    <h4>
    <?php echo $level3data[0]['param_heb_name']; ?>
        </h4>
    <ul id="sortable1" class="droptrue">
        <?php
            foreach ($level3data as $param)
            {
                Yii::app()->controller->renderPartial('_paramRow',
                        array('id'=>$param['param_id'],'name'=>$param['param_value'],'widget'=>$this)
                        );
            }
        ?>
    </ul>
</div>    