<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs = array(
    'Ordens' => array('index'),
    'Create',
);
Yii::app()->clientScript->registerScript('helloscriptEquipo', "initCreate();", CClientScript::POS_READY);
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a.link-fancy',
    'config' => array(),
        )
);
?>

<script type="text/javascript">
    var urlCrearEquipo = '<?php echo Yii::app()->createAbsoluteUrl("equipo/CreateEOrden"); ?>';
    var url = '<?php echo Yii::app()->createAbsoluteUrl("especificacion/getEspecificationList"); ?>';
    var urlCrearTipoEquipo = '<?php echo Yii::app()->createAbsoluteUrl("tipoequipo/createFancy"); ?>';
    var urlCrearMarca = '<?php echo Yii::app()->createAbsoluteUrl("marca/getEspecificationList"); ?>';
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
        <div id="addEquipo"></div>
    </div>
    <div>
        <label>Marca</label>
        <?php
        echo CHtml::dropDownList('marcaInput', 'marcaInput', $marca['list'], null);
        ?>
        <div id="addMarca"></div>
    </div>
    <div class="row">
        <label>Especificacion</label>
        <input type="text" id="nombreEspecificacion"></input>
    </div>
    <button id="CrearEquipoBtn">Crear Equipo</button>
    <a id="createEspecificacionEquipo"></a>
</div>

<script type="text/javascript">
    var linkEspeficicacion=$("#createEspecificacionEquipo");
    $("#CrearEquipoBtn").click(function(){
        var clienteId=$("#idClienteLbl").text();
        var marca=$("#marcaInput").val();
        var especificacion=$("#nombreEspecificacion").val();
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
    initCreate= function(){
        linkEspeficicacion.fancybox({});
        $("#addEquipo").button({
            icons: {
                primary: "ui-icon-plus"
            },
            text: false
        }).click(function(){
            linkEspeficicacion.attr("href",urlCrearTipoEquipo);
            linkEspeficicacion.click();
        });
        $("#addMarca").button({
            icons: {
                primary: "ui-icon-plus"
            },
            text: false
        }).click(function(){
            linkEspeficicacion.attr("href",urlCrearMarca);
            linkEspeficicacion.click();
        });
    }
</script>