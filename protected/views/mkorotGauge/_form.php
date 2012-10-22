<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mkorot-gauge-form',
    'action'=>Yii::app()->createUrl('//mkorotGauge/create'),
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => true,
        'validationDelay' => 50,
        ),
));  ?>


<p class="note">השדות המסומנים ב <span class="required">*</span> הינם שדות חובה.</p>

<div class="messagebox" id="messageBox"></div>

	<div class="rows">
        <div class="right-col">
		<?php echo $form->labelEx($model,'gauge_id'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        //'name'=>'id', //name of the html field that will be generated
                        'attribute'=>'gauge_id',
                        'model'=>$model,
                        //'value'=>$model->gauge_id,
                        'sourceUrl'=>$this->createUrl('MkorotGauge/getGaugeOptionsAjax'),
                        'options'=>array(
                            'max'=>10, //specifies the max number of items to display
                            'select'=>'js:function(event, ui){
                                        $("#MkorotGauge_gauge_id").val(ui.item["id"]);
                                        //alert($("#MkorotGauge_gauge_id").val());
                                         var gaugeId = ui.item["id"];
                                         $.ajax({
                                                 url: "index.php?r=mkorotGauge/getGaugeAreaIdOptionsAjax",
                                                             type: "GET",
                                                             async: "false",
                                                             dataType: "json",
                                                             data: "term1=" + gaugeId,
                                                             success: function(data) {

                                                                //alert(data["areaName"]);
                                                                $("#MkorotGauge_area_id").val(data["areaId"]);
                                                                $("#areaName").val(data["areaName"]); return false;
                                                            },
                                                             error: function(data) {
                                                               // alert(data.responseText);
                                                            }
                                          });


                                }',
                            'change'=>'js:function(event,ui) {
                                     //if the user delete the selected value, than the hiddenfield value will be set to null
                                    if(!ui.item)
                                    {
                                        $("#MkorotGauge_gauge_id").val("");
                                        //alert("נא לבחור חיבור");
                                        //focus(this);
                                    }
                                }
                                '
                        ),
                        'htmlOptions'=>array(
                            'class'=>'rounded',
                        ),
                    ));
        ?>
		<?php echo $form->error($model,'gauge_id'); ?>
        </div><!-- right -->

        <div class="middle-col">
        <?php /*
		<?php echo $form->labelEx($model,'area_id'); ?>
		<?php //echo $form->dropDownList($model,'area_id',MkorotGauge::model()->getAreaOptions()); ?>
        <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'name'=>'area', //name of the html field that will be generated
        'sourceUrl'=>$this->createUrl('MkorotGauge/getAreaOptionsAjax'),
        'options'=>array(
            //'minLength'=>'2',
            'matchCase'=>true, //match case when performing a lookup?
            'max'=>10, //specifies the max number of items to display
            'select'=>'js:function(event, ui){ $("#MkorotGauge_area_id").val(ui.item.id); }',
        ),
        'htmlOptions'=>array(
            //'style'=>'height:20px;',
            'class'=>'rounded'
        ),
    ));
        ?>
 */ ?>
        <?php echo $form->labelEx($model,'area_id'); ?>
        <?php echo CHtml::textField('area_id','',array('disabled'=>'true','class'=>'rounded','id'=>'areaName')); ?>
        <?php echo $form->hiddenField($model,'area_id'); ?>
        <?php echo $form->error($model,'area_id'); ?>
         </div><!-- middle -->

	    <div class="left-col">
		<?php echo $form->labelEx($model,'years'); ?>
		<?php echo $form->textField($model,'years',array('class'=>'rounded')); ?>
		<?php echo $form->error($model,'years'); ?>
        </div><!-- left -->
</div><!-- row -->
	<div class="rows">
        <div class="right-col">
		<?php echo $form->labelEx($model,'months'); ?>
		<?php //echo $form->textField($model,'months',array('class'=>'rounded')); ?>
		<?php //echo $form->dropDownList($model,'months',Yii::app()->getLocale()->monthNames,array('class'=>'rounded'))  ?>
        <?php /*$this->widget('ext.combobox.EJuiComboBox', array(
                                    'model' => $model,
                                    'attribute' => 'months',
                                    // data to populate the select. Must be an array.
                                    'data' =>Yii::app()->getLocale()->monthNames,
                                    'theme'=>'redmond',
                                    // options passed to plugin
                                    'options' => array(
                                        // JS code to execute on 'select' event, the selected item is
                                        // available through the 'item' variable.
                                        'onSelect' => 'alert("selected value : " + item.value);',
                                        // JS code to be executed on 'change' event, the input is available
                                        // through the '$(this)' variable.
                                        'onChange' => 'alert("changed value : " + $(this).val());',
                                        // If false, field value must be present in the select.
                                        // Defaults to true.
                                        'allowText' => false,
                                    ),
                                    // Options passed to the text input
                                    'htmlOptions' => array('class'=>'rounded'),
                                ));*/
        ?>
        <?php  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name'=>'months',
            /*'attribute'=>'months',
            'model'=>$model,*/
            //'value'=>$model->gauge_id,
            'sourceUrl'=>$this->createUrl('MkorotGauge/getMonthNamesAjax'),
            'options'=>array(
                'minLength'=>'0',
                'select'=>'js:function(event,ui) {

                                            $("#MkorotGauge_months").val(ui.item.id);

                                             $.ajax({
                                                 url: "index.php?r=mkorotGauge/getPeriodNamesAjax",
                                                             type: "GET",
                                                             async: "false",
                                                             dataType: "json",
                                                             data: "month=" + ui.item.id,
                                                             success: function(data) {

                                                                //alert(data[0]["period"]);

                                                               $("#periodName").val(data[0]["period"]);
                                                               $("#MkorotGauge_period").val(data[0]["period"]); return false;
                                                            },
                                                             error: function(data) {
                                                               alert(data.responseText);
                                                            }
                                          });


                                    }',

                'change'=>'js:function(event,ui) {
                                            //if the user delete the selected value, than the hiddenfield value will be set to null
                                            if(!ui.item)
                                            {
                                                $("#MkorotGauge_months").val("");
                                            }
                                }',

                /*'search'=>'js:function(event, ui) {

                                   //alert("focus");
                                }'*/
            ),
            'htmlOptions'=>array(
                'class'=>'rounded',

            ),
        ));

        ?>
        <?php echo $form->hiddenField($model,'months'); ?>
		<?php echo $form->error($model,'months'); ?>
        </div><!-- right -->

	    <div class="middle-col">
		<?php echo $form->labelEx($model,'period'); ?>
		<?php //echo $form->textField($model,'period',array('class'=>'rounded')); ?>
        <?php echo CHtml::textField('period','',array('disabled'=>'true','class'=>'rounded','id'=>'periodName')); ?>
        <?php echo $form->hiddenField($model,'period'); ?>
		<?php echo $form->error($model,'period'); ?>
        </div><!-- middle -->

	    <div class="left-col">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('class'=>'rounded')); ?>
		<?php echo $form->error($model,'amount'); ?>
	    </div><!-- left -->
</div><!-- row -->
	<div class="row buttons">
		<?php echo CHtml::ajaxSubmitButton('הוסף',array('MkorotGauge/create'),
                    //reload the gridview and reset the form ajaxly after submitting
                    array('success'=>'function(data) {
                                if (data) {
                                    //reset the form
                                    $("#mkorot-gauge-form").each
                                            (function(){this.reset();
                                            
                                    //reload the gridview
                                    $("#mkorotDataGrid").load(location.href+" #mkorotDataGrid>*", "");return false;
                                        });
                                        //focus back to the first input
                                        $("#MkorotGauge_gauge_id").focus();
                    					$("#messageBox").removeClass().addClass("confirmbox").html("הנתונים נוספו בהצלחה").fadeIn(2000).fadeOut(4000);
                                }
                                else {
                                    //return false;
                                }
                            }'
                    ),
                    //htmlOptions
                    array('class'=>'ui-widget')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->


<script type=text/javascript>
    //makes the months menu to open when the user focuses on the months input field
    $("#months").focus(function(){
        var e = jQuery.Event("keydown");
        e.which = 8;      //backspace
        $(this).trigger(e);
    });
    //change the hidden input data when the visible data has changed
    $("#months").change(function() {

       $("#MkorotGauge_months").val($(this).val());
       
       //if the month input is deleted, the period name and id will be deleted
       if ($(this).val().length == 0) 
           {
               $("#periodName").val('');
               $("#MkorotGauge_period").val('');
           }
       

    });
    
    //if the gauge_id input is deleted, the area_id and name will be deleted
    $("#MkorotGauge_gauge_id").change(function() {
            $("#MkorotGauge_area_id").val('');
            $("#areaName").val('');
    });


    
    
	//NGridView extension
    //add a click event to the grid view cell
    /*$(document).on('click', 'td', function(){
    	//alert($(this).parent().attr('primaryKey'));
    	$(this).html("<form><div id='text1'><input type='text' name='textbox1'></div></form>");
    	
    });*/

				
	
    
</script>