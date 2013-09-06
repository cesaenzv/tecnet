<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs = array(
    'Ordens' => array('index'),
    'Create',
);
Yii::app()->getClientScript()->registerCssFile('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.ui.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('helloscriptEquipo', "initCreate();", CClientScript::POS_READY);
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a.link-fancy',
    'config'=>array(),
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
    <button id="CrearEquipoBtn">CrearEquipo</button>
    <a id="createEspecificacionEquipo"></a>
</div>

<script type="text/javascript">
    var linkEspeficicacion=$("#createEspecificacionEquipo");
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