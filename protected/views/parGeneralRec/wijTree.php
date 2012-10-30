<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/easyui/jquery.easyui.min.js"); ?>

<script id="scriptInit" type="text/javascript">
        
        
                
                
      
      
        
        $(document).ready(function () { 
            $.ajax({
                    //get the attributes labels ajaxly
                    url: "index.php?r=parGeneralRec/getTreeAjax",
                    type: "POST",
                    async: "false",
                    dataType: "text",
                    data: "param_name=gauge_state",
                    success: function(data1){
                       $('#tree').tree('append', {  
                        parent:node.target,  
                        data:data1
                        });  
                        
                        
                    }
                            
                });
        });        
    </script>
  
  
  
       
                <ul id="tree"> 
                      
                </ul> 
       