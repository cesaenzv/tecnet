
<script type="text/javascript"> 

	var guardarGarantia = '<?php echo Yii::app()->createAbsoluteUrl("equipo/CreateEMantenimiento"); ?>';
    var ordenesEquipo = '<?php echo Yii::app()->createAbsoluteUrl("equipo/GetOrdenesEquipo"); ?>';


</script>

<div class="form">
    <div class="row">
        <label>Identificacion del Cliente</label>
        <label id="idClienteLbl"><?php echo $idC ?></label>
    </div>

    <div class="oneFilerow">
        <label>Tecnico
            <?php
            echo CHtml::dropDownList('userTec', 'userTec', $users, null);
            ?>
        </label>
        
        <label>Equipos
            <?php
            echo CHtml::dropDownList('equipoId', 'equipoId', $equipos, null);
            ?> 
        </label>
                
    </div>

    <div style="margin: 0 20%;">
        <table id="tableGridOrden"></table>
        <div id="pagerGridOrden"></div>
    </div>

    <div class="row">
        <label>Descripcion</label>
        <textarea id="txtDescripcion" rows="4" cols="40" maxlength="250"></textarea>        
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
            rowNum: 10,
            rowList: [10, 20, 30, 40, 50, 60],
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