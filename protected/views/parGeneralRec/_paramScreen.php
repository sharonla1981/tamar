<style>
    #sortable1, #sortable2, #sortable3 { list-style-type: none; margin: 0; padding: 0; float: right; margin-right: 10px; background: #eee; padding: 5px; width: 143px;}
    #sortable1 li, #sortable2 li, #sortable3 li { margin: 5px; padding: 5px; font-size: 1.2em; width: 120px; text-align: right}
</style>

<?php       

//the data array of the data provider
$dataP = $dataProvider->getData();
$level1data = $level1dataProvider->getData();
$level2data = $level2dataProvider->getData();
$level3data = $level3dataProvider->getData();

$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'paramView',
				'dataProvider'=>$dataProvider,
				//'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridView2.css'),
                                //'cssFile' => Yii::app()->baseUrl . '/css/gridView2.css',
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
						),
			));


/*$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_mainParamRow',   // refers to the partial view named '_post'
    'sortableAttributes'=>array(
        'title',
        'create_time'=>'Post Time',
    ),
));*/
?>
<div id="mainTbl" style="float: right;font-size: 10px;background: #F8F8F8">
        <?php
            
            //Yii::app()->controller->renderPartial('mainParamTbl',array('dataProvider'=>$dataP));
            
        ?>
</div>   

<script type="text/javascript">
    $(function() {
        $("ul.droptrue").sortable({
            connetWith: "td"
        });
        
        $("ul.droptrue").hover(function(){
            $(this).css('cursor','pointer');
        });
        
        $("td.droptrue").droppable({
            drop: function(event,ui){
                alert($(this).attr('name'));
                alert(ui.draggable.attr('paramId'));
            }
        })
    });
</script>
<br />
<hr>
<div id="paramLevel1" style="border: 5px;border-color: black;float: right;text-align: center;" level="2">
    <h4>
    <?php echo $level1data[0]['param_heb_name']; ?>
        </h4>
    <ul id="sortable1" class="droptrue">
        <?php
            foreach ($level1data as $param)
            {
                Yii::app()->controller->renderPartial('_paramRow',
                        array('id'=>$param['param_id'],'name'=>$param['param_value'],'widget'=>$this)
                        );
            }
        ?>
    </ul>
</div>
<div id="paramLevel2" style="border: 5px;border-color: black;float: right;text-align: center;" level="2">
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
  