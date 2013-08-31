<?php
$this->breadcrumbs = array(
    'Ordens' => array('index'),
    'Create',
);
Yii::app()->clientScript->registerScript('helloscript', "init();", CClientScript::POS_READY);
?>
<div id="equiposMantenimiento" >
    <table id="equiposMantenimientoGrid"></table>
    <div id="equiposMantenimientoGridPager"></div>
</div>
<div id="ordenMantenimiento" style="display:none">
    <table id="ordenMantenimientoGrid"></table>
    <div id="ordenMantenimientoGridPager"></div>
</div>
<script type="text/javascript">
    var url="<?php echo Yii::app()->createUrl("orden/proceso", array("id" => $id,'equipo'=>'')); ?>"
    init = function(){
        $("#equiposMantenimientoGrid").jqGrid({
            url: "<?php echo Yii::app()->createUrl("orden/GetEquiposPaquete", array("id" => $id)); ?>",
            datatype: "json",
            mtype: "POST",
            colNames: ["ID", "Serial","Especificación","Estado"],
            colModel: [
                {
                    name: "k_idEquipo", 
                    width: 200,                    
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },

                {
                    name: "n_nombreEquipo", 
                    width: 200,
                    editable:true,
                    hidden:false,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },

                {
                    name: "k_idEspecificacion", 
                    width: 200,
                    editable:true,
                    hidden:false, 
                    edittype: "select",
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },

                {
                    name: "i_inhouse", 
                    width: 100, 
                    align: "right",
                    editable:true,
                    edittype: "select",
                    hidden:false,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                }
            ],
            pager: "#equiposMantenimientoGridPager",
            rowNum: 20,
            rowList: [10, 20, 30],
            sortname: "k_idEquipo",
            sortorder: "desc",
            viewrecords: true,
            gridview: true,
            autoencode: true,
            caption: "Equipos"
        });
        $("#equiposMantenimientoGrid").jqGrid('navGrid', '#equiposMantenimientoGridPager', {
            edit : false,
            add : false,
            del : false,
            search :false,
            closeAfterEdit: false,
            closeAfterAdd:false
        }).navButtonAdd("#equiposMantenimientoGridPager", {
            caption: "Asignar servicios", 
            buttonicon: "ui-icon-newwin",
            onClickButton: function (data) { 
                var rowid = jQuery("#equiposMantenimientoGrid").jqGrid('getGridParam', 'selrow');
                var ret = jQuery("#equiposMantenimientoGrid").getRowData(rowid);
                if($.toJSON(ret)=="{}"){
                    alert("Debe seleccionar un equipo para asignar servicios");
                    return false;
                }
                ordenMantenimiento(ret);
            }
        });
    }
    ordenMantenimiento=function(data){
        $("#ordenMantenimiento").show();
        $('#ordenMantenimientoGrid').jqGrid('GridUnload');
        $("#ordenMantenimientoGrid").jqGrid({
            url: url+data.k_idEquipo,
            datatype: "json",
            mtype: "POST",
            colNames: ["ID", "Serial","Especificación","Estado"],
            colModel: [
                {
                    name: "k_idEquipo", 
                    width: 200,                    
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },

                {
                    name: "n_nombreEquipo", 
                    width: 200,
                    editable:true,
                    hidden:false,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },

                {
                    name: "k_idEspecificacion", 
                    width: 200,
                    editable:true,
                    hidden:false, 
                    edittype: "select",
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },

                {
                    name: "i_inhouse", 
                    width: 100, 
                    align: "right",
                    editable:true,
                    edittype: "select",
                    hidden:false,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                }
            ],
            pager: "#ordenMantenimientoGridPager",
            rowNum: 20,
            rowList: [10, 20, 30],
            sortname: "k_idEquipo",
            sortorder: "desc",
            viewrecords: true,
            gridview: true,
            autoencode: true,
            caption: "Equipos"
        });
        $("#ordenMantenimientoGrid").jqGrid('navGrid', '#ordenMantenimientoGridPager', {
            edit : false,
            add : true,
            del : false,
            search :false,
            closeAfterEdit: false,
            closeAfterAdd:false
        });
    }
</script>