<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	'Create',
);

Yii::app()->clientScript ->registerCoreScript('jquery')
?>

<script type="text/javascript">
	var urlCrearEquipo = '<?php echo Yii::app()->createAbsoluteUrl("equipo/CreateEOrden"); ?>';
</script>


<div class="form">
	<div class="row">
		<label>Nombre Equipo</label>
		<input type="text" value='<?php	echo $clienteId?>' id="nombreEquipo"></input>
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