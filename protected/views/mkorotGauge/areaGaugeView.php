<?php Yii::app()->clientScript->registerScriptFile("http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.7.1.min.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile("http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.17/jquery-ui.min.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.wijmo-open.all.2.0.0.min.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.wijmo-complete.all.2.0.0.min.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/globalize.culture.he-IL.js"); ?>

<script id="scriptInit" type="text/javascript">
        
                        
        $(document).ready(function () {
            //set the wijmo grid insite the ajax call for the attributes labels JSON object
            $.ajax({
                    //get the attributes labels ajaxly
                    url: "index.php?r=mkorotGauge/getMkorotGaugeCols",
                    type: "GET",
                    async: "false",
                    dataType: "json",
                    success: function(data){
                        
                        //get an json object which contains the areaGauge table data
                        var proxy = new wijhttpproxy({ 
                        url: "index.php?r=mkorotGauge/getGaugesAjax", 
                        dataType: "json" 
                        });
                        
                        //the data variable holds the columns names
                        var cols = new wijarrayreader(data);                     
                        
                        
                        var dataSource = new wijdatasource({
                            proxy: proxy,
                            reader: cols
                        });
                
                        dataSource.load();
                        
                        $("#mkorotGauge").wijgrid({
                            allowEditing: true,  
                            allowSorting: true,
                            culture: "he",
                            allowPaging: true,
                            afterCellUpdate: onAfterCellUpdate,  
                            pageSize: 10, 
                            data: dataSource 
                            })
                    }
                            
                });
           
            
            
            
            
            
            function onAfterCellUpdate(e, args) { 
                alert(args.cell.value()); 
            } 

             
        }); 
    </script>
  
  
     
            <table id="mkorotGauge"> 
            </table> 
            