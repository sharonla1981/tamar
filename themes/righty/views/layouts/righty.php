<?php $this->beginContent('//layouts/main'); ?>

<div class="container">

	<div id="content" class="span-20" style="border-right: 1pt  ridge #a9a9a9; ">
		<?php echo $content; ?>

	</div><!-- content -->

	<div class="span-6"  >

		<p>
	<?php $panelsArray = array();
			
			//add the basic first pane
			$panelsArray['פעולות'] = CHtml::link('נתוני מקורות','index.php?r=MkorotGauge/index');
			//$panelsArray['פעולות2'] = Yii::app()->controller->id;
			if (Yii::app()->controller->id == 'parGeneralRec')
			{
				$panelsArray['עדכון נתונים'] = $this->renderPartial('_pane2',null,true);
			}
			
	?>
	<?php	$this->widget('zii.widgets.jui.CJuiAccordion', array(
					'id'=>'rightPanel',
                    'panels'=>/*array(
					'פעולות'=>CHtml::link('נתוני מקורות','index.php?r=MkorotGauge/index'),*/
					 $panelsArray,
					 					
                    //'פעולות נוספות'=>Yii::app()->
                    // panel 3 contains the content rendered by a partial view
                    //'panel 3'=>$this->renderPartial('_partial',null,true),
                    
                    // additional javascript options for the accordion plugin
                    'options'=>array(
                        'animated'=>'bounceslide',
                    ),
                ));
	
			
			
			
        ?>
		</p>

    </div>

</div>
<?php $this->endContent(); ?>
<script type="text/javascript">       

//fix the accordion problem which makes the scroll bars appeare
$("#rightPanel").accordion({
    'fillSpace': true,
    //'clearStyle': true
});

</script>
