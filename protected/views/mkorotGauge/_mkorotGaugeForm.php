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

            $this->widget('zii.widgets.grid.CGridView', array(
            //$this->widget('ext.NGridView.NGridView', array(
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

            