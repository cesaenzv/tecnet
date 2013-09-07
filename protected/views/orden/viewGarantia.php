<?php
	$this->breadcrumbs=array(
		'Ordens'=>array('index'),
		'Ver Garantias',
	);

	echo $this->renderPartial('_clientTemplate');
	$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a.link-fancy',
    'config'=>array(),
    )
	);
?>

<script type="text/javascript">
	
    var	searchClientUrl = '<?php echo Yii::app()->createAbsoluteUrl("Cliente/SearchClient"); ?>';
    var	createEquipoGridUrl = '<?php echo Yii::app()->createAbsoluteUrl("Cliente/GetEquipoGrid"); ?>'; 
    var urlView = '<?php echo Yii::app()->createAbsoluteUrl("equipo/CreateEMantenimientoView"); ?>';
</script>

<a style="display: block" class="link-fancy" href="" id="createCliente"></a>

<h1>Ordenes de Garantia</h1>

<div class="form">
    <div class="row">
        <label class="required">Usuario <span class="required">*</span></label>
        <input type="text" id="Orden_k_idUsuario" name="Orden[k_idUsuario]">        
        <select required="" id="typeDocument">
            <option value="CC">CC</option>
            <option value="NIT">NIT</option>       
            <option value="TI">TI</option>       
            <option value="CE">CE</option>       
            <option value="PA">PA</option>       
        </select>        
        <a id="searchClient"></a>
    </div>
    <div id="clientData"></div>
    <table id="garantiaGrid"></table>    
    <div id="pagerGarantiaGrid"></div>

    <a href='<?php
    echo Yii::app()->createAbsoluteUrl("equipo/CreateEMantenimientoView/");
    ?>' id="callViewCrearMantenimiento" class="link-fancy"></a>

</div>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/modules/garantiaModule.js'); ?>