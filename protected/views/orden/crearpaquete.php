<?php
$this->breadcrumbs = array(
    'Ordens' => array('index'),
    'Create',
);
Yii::app()->clientScript->registerScript('helloscript', "init();", CClientScript::POS_READY);
$usuarioRoles=Authassignment::model()->findAll("itemname like '%ecnico%'");
$nombreUsuario=array();
$i=0;
foreach ($usuarioRoles as $usuarios){
    $usu=  Users::model()->findByPk($usuarios->userid);
    $nombreUsuario[$usuarios->userid]=$usu->username;
    $i++;
}

?>
<h2>Orden <?php echo $id ?></h2>
<label id="mensaje"></label>

<div  id="equiposMantenimiento" style="margin-bottom:1em;">
    <table id="equiposMantenimientoGrid"></table>
    <div id="equiposMantenimientoGridPager"></div>
</div>
<div id="ordenMantenimiento" style="margin-bottom:1em;">
    <table id="ordenMantenimientoGrid"></table>
    <div id="ordenMantenimientoGridPager"></div>
</div>
<div>
    <span>Tecnico Asignado </span>
    <?php
        echo CHtml::dropDownList('usuarios', "username", $nombreUsuario,null);
    ?>
</div>
<div class="oneFilerow">
    <label>Días de garantia 
    <input type="number" id="garantia" value="30" /> </label>
    <label style="margin-left:4em">Descuento 
    <input type="number" id="descuento" value="0" /> </label>
</div>
<div class="oneFilerow">
    <label>Observaciones 
    <textarea id="observaciones" cols="22" rows="5"></textarea></label>
    <label style="margin-left:4em">Accesorios 
    <textarea id="accesorios" cols="22" rows="5"></textarea></label>
</div>

<div id="crearAsignacion">Guardar</div>
<div id="prevOrden">previsualizar orden</div>

<script type="text/javascript">
    var equiposMantenimiento = new Array();
    var url="<?php echo Yii::app()->createUrl("orden/proceso", array("id" => $id, 'equipo' => '')); ?>"
    init = function(){
        ordenMantenimiento();
        $("#equiposMantenimientoGrid").jqGrid({
            url: "<?php echo Yii::app()->createUrl("orden/GetEquiposPaquete", array("id" => $id)); ?>",
            datatype: "json",
            mtype: "POST",
            colNames: ["ID", "Serial","Especificación",""],
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
                    name: "fk_idpaqMantenimiento", 
                    width: 100, 
                    align: "right",
                    editable:true,
                    edittype: "select",
                    hidden:true,
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
        });
        
        $("#ordenMantenimientoGrid").jqGrid({
            url: "<?php echo Yii::app()->createUrl("orden/GetServicios"); ?>",
            datatype: "json",
            mtype: "POST",
            colNames: ["Servicio", "Costo"],
            colModel: [
                {
                    name: "n_nomServicio", 
                    width: 200,                    
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },

                {
                    name: "v_costoServicio", 
                    width: 200,
                    editable:true,
                    hidden:false,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
            ],
            pager: "#ordenMantenimientoGridPager",
            rowNum: 20,
            rowList: [10, 20, 30],
            sortname: "k_idServicio",
            sortorder: "desc",
            viewrecords: true,
            gridview: true,
            autoencode: true,
            caption: "Servicios",
            multiselect: true
        });
        $("#ordenMantenimientoGrid").jqGrid('navGrid', '#ordenMantenimientoGridPager', {
            edit : false,
            add : false,
            del : false,
            search :false,
            closeAfterEdit: false,
            closeAfterAdd:false
        });
    }
    datoEnArray=function(dato,arreglo){
        for(var i=0; i<arreglo.length; i++){
            if(arreglo[i]==dato){
                return true;
            }
        }
        return false;
    }
    ordenMantenimiento=function(){
    $("#prevOrden").button().click(function(){
        window.open('<?php echo Yii::app()->request->baseUrl . Yii::app()->createUrl("orden/viewPDF", array("id" => $id)); ?>', '_blank', 'height=600,width=850,toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no');
    });
    $("#crearAsignacion").button().click(function(){
        var equipoId = jQuery("#equiposMantenimientoGrid").jqGrid('getGridParam', 'selrow');
        var dataEquipo = jQuery("#equiposMantenimientoGrid").getRowData(equipoId);

        if(equipoId==null){
            alert("Debe seleccionar un equipo para asignar servicios");
            return false;
        }
        if(datoEnArray(dataEquipo.fk_idpaqMantenimiento,equiposMantenimiento)){
            alert("Ya se asigno servicio al equipo");
            return false;
        }else{
            equiposMantenimiento.push(dataEquipo.fk_idpaqMantenimiento);
        }
        var serviciosId = jQuery("#ordenMantenimientoGrid").jqGrid('getGridParam', 'selarrrow');
        if(serviciosId==null){
            alert("Debe seleccionar por lo menos un servicio para asignar");
            return false;
        }
        mensaje="Esta seguro que desea realizar esta acción, recuerde que no se puede deshacer";
            if(confirm(mensaje)){
                var param={
                    paqueteMantenimiento:dataEquipo.fk_idpaqMantenimiento,
                    servicios:serviciosId,
                    tecnico:$("#usuarios").val(),
                    garantia:$("#garantia").val(),
                    descuento:$("#descuento").val(),
                    observaciones:$("#observaciones").val(),
                    accesorios:$("accesorios").val()
                }
                $.ajax({
                    type: "POST",
                    url: "<?php echo Yii::app()->createUrl("orden/createProceso"); ?>",
                    data:param,
                    success: function(response){
                        if(response.mensaje=="Fail"){
                            $("#mensaje").css("color","#ff0000");
                        }else{
                            $("#mensaje").css("color","#00ff00");
                        }
                        $("#mensaje").text(response.message);
                    },
                    dataType: 'json'
                });
            }
    });
    }
</script>