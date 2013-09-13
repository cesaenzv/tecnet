<?php 
Yii::app()->getClientScript()->registerCssFile('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/ui.jqgrid.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.ui.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/grid.locale-es.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.jqGrid.src.js', CClientScript::POS_HEAD);

?>
<script type="text/javascript"> 

	var guardarGarantia = '<?php echo Yii::app()->createAbsoluteUrl("equipo/CreateEMantenimiento"); ?>';
    var ordenesEquipo = '<?php echo Yii::app()->createAbsoluteUrl("equipo/GetOrdenesEquipo"); ?>';


</script>

<div class="form">
    <div>
        <label>Identificacion del Cliente</label>
        <label id="idClienteLbl"><?php echo $idC ?></label>
        <label>Tecnico</label>
        <?php
        echo CHtml::dropDownList('userTec', 'userTec', $users, null);
        ?>   
    </div>
    <div>
    	<label>Equipos</label>
        <?php
        echo CHtml::dropDownList('equipoId', 'equipoId', $equipos, null);
        ?>        
    </div>

    <div>
        <table id="tableGridOrden"></table>
        <div id="pagerGridOrden"></div>
    </div>

    <div class="row">
        <label>Descripcion</label>
        <textarea id="txtDescripcion" rows="10" cols="25"></textarea>
        
    </div>
    <button id="crearGarantia">Crear Garantia</button>    
</div>



<script>
    var garantiaGrid = "#tableGridOrden";
    var pagerGrid = "#pagerGridOrden";
	bindEventsFancy = function (){
        $("#crearGarantia").click(function(e){
            e.preventDefault();
            guardarNuevaGarantia();
        });
        gridOrdenGarantia($("#equipoId").val());
        $("#equipoId").change(function(){
            gridOrdenGarantia($(this).val());    
        });
    },
    gridOrdenGarantia = function (idEquipo){
        $(garantiaGrid).jqGrid("clearGridData");
        $(garantiaGrid).jqGrid("GridUnload");
        $(garantiaGrid).jqGrid({
            loadtext:"Cargando datos...",
            url: ordenesEquipo+"?id="+idEquipo,
            emptyrecords: "Sin registros",
            loadonce:false,
            datatype: "json",
            mtype: "POST",
            colNames: ["Orden #", "Dias", "Vigente"],
            colModel: [
            {
                name: "idOrden", 
                width: 80,
                hidden:false,                    
                editrules:{
                    edithidden:true, 
                    required:true
                }
            },
            {
                name: "diasGarantia", 
                width: 80,
                editable:true,
                hidden:false,
                editrules:{
                    edithidden:true, 
                    required:true
                }
            },
            {
                name: "vigencia", 
                width: 80,
                editable:true,
                hidden:false,
                editrules:{
                    edithidden:true, 
                    required:true
                }
            }
            ],
            pager: pagerGrid,
            rowNum: 20,
            rowList: [20, 40, 60],
            sortname: "k_idOrden",
            sortorder: "desc",               
            viewrecords: true,
            gridview: true,
            autoencode: true,
            caption: "Ordenes equipo",
            multiselect: false,
        }).navGrid(pagerGrid, {
            edit : false,
            add : false,
            del : false,
            search :false,
            closeAfterEdit: true,
            closeAfterAdd:true
            }).navButtonAdd(pagerGrid, {
            caption: "", 
            buttonicon: "ui-icon-circle-plus",
            onClickButton: function (data) { 
                agregarMantenimiento();
            },
            position: "first", 
            title: "Nuevo Mant.", 
            cursor: "pointer"
        });
        
        $(garantiaGrid).jqGrid('filterToolbar',{stringResult: true, searchOnEnter : false});
    },
    guardarNuevaGarantia = function(){
        console.log("Guardar Garantia");
         $.ajax({
         	type:"POST",
            url:guardarGarantia,
            dataType: "json",
            data: {
                idCliente : $("#idClienteLbl").text(),
                tecnicoId : $("#userTec").val(),
                equipoId : $("#equipoId").val(),
                descripcion : $("#txtDescripcion").val()
            },
            success:function(data){
                if(data.msg == "OK"){
                	$("#garantiaGrid").trigger("reloadGrid");                	
                    alert("Por favor cierre la ventana el proceos fue exitoso");
                }else{
                    alert("Hubo un inconveniente");
                }
            },
            error:function(){
                console.log("error");
            }
        });
    };	
    bindEventsFancy();
</script>