<div style="border: 5px;border-color: black;float: right;text-align: center;font-size: 10px">
    <h3 style="text-align: center">
        <?php echo $dataProvider[0]['lev1Title']; ?>
        </h3>
<ul id="sortable1">
    
   <?php
   
        foreach ($dataProvider as $param)
            {
                Yii::app()->controller->renderPartial('_paramRow',
                        array('id'=>$param['lev1Id'],'name'=>$param['lev1Val'],'widget'=>$this)
                        );
            }
        //Yii::app()->controller->renderPartial('_paramRow',array('id'=>$lev1Id,'name'=>$lev1Name));
   ?>
    
</ul>
</div>

<div style="border: 5px;border-color: black;float: right;text-align: center; font-size: 10px">
    <h3 style="text-align: center">
        <?php echo $dataProvider[0]['lev2Title']; ?>
        </h3>
<ul id="sortable1">
    
   <?php
   
        foreach ($dataProvider as $param)
            {
                Yii::app()->controller->renderPartial('_paramRow',
                        array('id'=>$param['lev2Id'],'name'=>$param['lev2Val'],'widget'=>$this)
                        );
            }
        //Yii::app()->controller->renderPartial('_paramRow',array('id'=>$lev1Id,'name'=>$lev1Name));
   ?>
    
</ul>
</div>