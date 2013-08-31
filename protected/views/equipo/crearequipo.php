<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	'Create',
);
Yii::app()->getClientScript()->registerCssFile('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
Yii::app()->clientScript ->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.ui.js', CClientScript::POS_HEAD);
?>

<script type="text/javascript">
	var urlCrearEquipo = '<?php echo Yii::app()->createAbsoluteUrl("equipo/CreateEOrden"); ?>';
	var url = '<?php echo Yii::app()->createAbsoluteUrl("especificacion/getEspecificationList"); ?>';
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

	<label>Marca</label>
	<?php
		
		echo CHtml::dropDownList('marcaInput', 'marcaInput', $marca['list'],null);
	?>
	<label>Tipo Equipo</label>
	<?php			
		echo CHtml::dropDownList('tipoequipoInput', 'tipoequipoInput', $tipoEquipo['list'],null);

	?>	
	<div class="row">
		<label>Especificacion</label>
		<input type="text" id="nombreEspecificacion"></input>
	</div>
	<button id="CrearEquipoBtn">CrearEquipo</button>

</div>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/modules/orderModule.js'); ?>