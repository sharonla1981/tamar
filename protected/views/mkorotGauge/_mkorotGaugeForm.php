<?php       //create the column header data from the model attributesLabels array
             /*    $columnsArray = array_values(MkorotGauge::model()->attributeLabels()); ?>
<?php

$this->widget('ext.htmlTableUi.htmlTableUi',array(
   // 'ajaxUrl'=>'site/handleHtmlTable',
   // 'arProvider'=>$dataProvider,
    'collapsed'=>false,
    'columns'=>$columnsArray,
    'cssFile'=>'',
    'editable'=>true,
    'enableSort'=>true,
    'exportUrl'=>'site/exportTable',
    'extra'=>' ',
    'footer'=>'סה"כ: '.count($dataProvider->getData()),
    'formTitle'=>'עדכון נתונים',
    'rows'=>$dataProvider->getData(),
    'sortColumn'=>1,
    'sortOrder'=>'desc',
    'subtitle'=>'',
    'title'=>'נתוני מקורות',
)); */
 ;
?>


<?php 

            //$this->widget('zii.widgets.grid.CGridView', array(
            $this->widget('ext.NGridView.NGridView', array(
            'dataProvider'=>$dataProvider,
            'id'=>'mkorotDataGrid',
                //lets tell the pager to use our own css file
                'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridView.css'),
                //the same for our entire grid. Note that this value can be set to "false"
                //if you set this to false, you'll have to include the styles for grid in some of your css files
                'cssFile' => Yii::app()->baseUrl . '/css/gridView.css',
                'htmlOptions' => array('class' => 'grid-view rounded','direction'=>'rtl'),
                'columns'=>array(
                    'gauge_id',
                    'years',
                    'months',
                    'period',
                    'amount',
                    'areas.areaName',
                     array(            // display a column with "view", "update" and "delete" buttons
                        'class'=>'CButtonColumn',
                     ),
                 )
            ));

?>


<script type="text/javascript">
    
    //global variable that contains the edited field value
    var editedInputValue;
    
    //add an input text box to the div when clicked.
    $('td div').click(function(){
        $(this).html('<input type="text" class="editable" onblur="leaveText(this)" onkeyup="inputUpdate(this)" name="edited" size="10'+ '"' + 'value="'+ $(this).text()+ '">' );
        
        if ($(this).children().attr('name') == "edited")
            {
                $(this).children().focus();
            }
        
    });
    
    /**
     * @input HTMLInputElement
     * this function triggered when input field is blured.
     * it sets the table cell to the input data was enterded by the user.
     * it call an update function(server-side) that will update the DB
     */
    function leaveText(input)
    {
        //set data variables that will be used to update the DB
        var primary = input.parentElement.parentElement.parentElement.getAttribute('primaryKey');
        var field_name = input.parentElement.getAttribute('id');
        //var content = input.getAttribute('value');
        var content = editedInputValue;
        
        
        //remove the text input and set the DIV content to be the input data
        input.parentElement.innerHTML = content;
        
        updateContent(content, primary, field_name);
        
    }
    
    //update the global inputValue variable to the current value was entered by the user
    function inputUpdate(input)
    {
        editedInputValue = input.value;
    }
    
    /**
     * @text - was entered by the user
     * @primary - the row primaryKey value
     * @fieldName - the field name that was edited
     */
    function updateContent(text,primary,fieldName)
    {
        $.ajax({
                url: "index.php?r=mkorotGauge/updateAjax",
                type: "POST",
                async: "false",
                //dataType: "json",
                data: "text=" + text + "&primary=" + primary + "&fieldName=" + fieldName,
                success: function(data) {
                    //alert(data);
               },
                error: function(data) {
                  // alert(data.responseText);
               }
         });
    }
    
</script>

            