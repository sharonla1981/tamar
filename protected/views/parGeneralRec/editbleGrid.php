<?php Yii::app()->clientScript->registerScriptFile("http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.7.1.min.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile("http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.17/jquery-ui.min.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.wijmo-open.all.2.0.0.min.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.wijmo-complete.all.2.0.0.min.js"); ?>


<script id="scriptInit" type="text/javascript">
        $(document).ready(function () { 
            $("#demo").wijgrid({
            	allowEditing: true,  
                allowSorting: true, 
                allowPaging: true,
                afterCellUpdate: onAfterCellUpdate,  
                pageSize: 10, 
                data: new wijdatasource({ 
                    proxy: new wijhttpproxy({ 
                        url: "index.php?r=parGeneralRec/getParamAjax", 
                        dataType: "json", 
                        /*data: { 
                            featureClass: "P", 
                            style: "full", 
                            maxRows: 1000, 
                            name_startsWith: "israel"
                        }, */
                        //key: "ParGeneralRec"
                    }),
                    reader: new wijarrayreader([ 
                                                { name: "param_name", mapping: "param_name" },
                                                 
                                             ]) 
            	}),
            	

            });
            
            function onAfterCellUpdate(e, args) { 
                alert(args.cell.value()); 
            } 

             
        }); 
    </script>
  
  
        <div class="main demo"> 
            <!-- Begin demo markup -->
            <table id="demo"> 
            </table> 
            <!-- End demo markup -->
            <div class="demo-options"> 
                <!-- Begin options markup -->
                <!-- End options markup -->
            </div> 
        </div> 
        <div class="footer demo-description"> 
            <p>This sample demonstrates the default wijgrid behavior. 
            </p> 
        </div> 