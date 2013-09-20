<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs = array(
    'Ordens' => array('index'),
    'Create',
);
Yii::app()->clientScript->registerScript('helloscriptEquipo', "initCreate();", CClientScript::POS_READY);
?>

<script type="text/javascript">
    var urlCrearEquipo = '<?php echo Yii::app()->createAbsoluteUrl("equipo/CreateEOrden"); ?>';
    var urlGetModelList = '<?php echo Yii::app()->createAbsoluteUrl("especificacion/getEspecificationList"); ?>';
</script>


<div class="form">
    <div class="row">
        <label>Identificacion del Cliente</label>
        <label id="idClienteLbl"><?php echo $clienteId ?></label>
    </div>

    <div class="row">
        <label>Serial</label>
        <input type="text" id="nombreEquipo"/>
    </div>

    <label>Tipo Equipo</label>

    <div>
        <?php
        echo CHtml::dropDownList('tipoequipoInput', 'tipoequipoInput', $tipoEquipo['list'], null);
        ?>
        <a style ="width:1.3em; float:none;" id="btnTipoEquipo" class="crear btn"></a>   
    </div>
    <div>
        <label>Marca</label>
        <?php
        echo CHtml::dropDownList('marcaInput', 'marcaInput', $marca['list'], null);
        ?>
        <a style ="width:1.3em; float:none;" id="btnMarca" class="crear btn"></a>
    </div>
    <div class="row">
        <label>Modelo</label>
        <div id="especificacionRow" style="display:inline-block;"></div>
        <a style ="width:1.3em; float:none;" id="btnEspecificacion" class="crear btn"></a>
    </div>
    <button id="CrearEquipoBtn">Crear Equipo</button>     
</div>

<div id="addTipoEquipo">
    <iframe id="iframe">
    </iframe>
</div>
<div id="addMarca">
    <iframe id="iframe">
    </iframe>
</div>
<div id="addEspecificacion">
    <iframe id="iframe">
    </iframe>
</div>

<script type="text/javascript">
    $("#CrearEquipoBtn").click(function(){
        var clienteId=$("#idClienteLbl").text();
        var marca=$("#marcaInput").val();
        var especificacion=$("#n_nombreEspecificacion").val();
        var tipoEquipo=$("#tipoequipoInput").val();
        var nombreEquipo=$("#nombreEquipo").val();
        if(nombreEquipo=="" ||tipoEquipo==""||especificacion==""||marca==""){
            alert("Todos los campos son obligatorios");
            return false;
        }        
        $.ajax({
            type: "POST",
            url:urlCrearEquipo,
            data: "clienteId="+clienteId+"&marca="+marca+"&especificacion="+especificacion+"&tipoEquipo="+tipoEquipo+"&nombreEquipo="+nombreEquipo,
            success: function(response){
                if(response.msg=="OK"){
                    alert("equipo creado satisfactoriamente.");
                }else{
                    alert(response.msg);
                }
            },
            dataType: 'json'
        });
    });
    var initCreate= function(){
        JQueryPlugin();
        $("#tipoequipoInput").change(getEspecificacion);
        $("#marcaInput").change(getEspecificacion);
        $("#btnTipoEquipo").click(function(){
            getViewDialog($("#addTipoEquipo"),"../../tipoequipo/createFancy/","Crear Nuevo Tipo de Equipo");
        });
        $("#btnMarca").click(function(){
            getViewDialog($("#addMarca"),"../../marca/createFancy/","Crear Nueva Marca");
        });
        $("#btnEspecificacion").click(function(){
            getViewDialog($("#addEspecificacion"),"../../especificacion/createFancy/","Crear Nuevo Modelo");
        });
        getEspecificacion();
    },
    JQueryPlugin = function(){
        $("#addTipoEquipo").dialog({autoOpen:false, close : function(){ window.location.reload()}});
        $("#addMarca").dialog({autoOpen:false, close : function(){ window.location.reload()}});
        $("#addEspecificacion").dialog({autoOpen:false, close : function(){ window.location.reload()}});
    },
    getEspecificacion = function(){
        $.ajax({
            type:"POST",
            url:urlGetModelList,
            dataType:"json",
            data: {marca:$("#marcaInput").val(), tipoEquipo:$("#tipoequipoInput").val()},
            success:function(data){

                var s = $('<select id=n_nombreEspecificacion name=n_nombreEspecificacion/>');
                $.each(data.list, function(index,val){
                    $('<option />', {value: index, text: val}).appendTo(s);
                });

                $("#especificacionRow").html(s);
            },
            error:function(error){
                console.log(error);
            }
        });
    },
    getViewDialog = function(obj, url,titulo){
        obj.dialog( "option", "title", titulo );
        obj.dialog( "option", "width", 450 );
        obj.dialog( "option", "height", 500 );            
        obj.dialog( "option", "resizable", false );
        obj.dialog("open");
        obj.find("#iframe").attr('src',url);
        obj.find("#iframe").attr('width',"440");
        obj.find("#iframe").attr('height',"500");      
        obj.dialog( "option", "position", "center");
    };

</script>