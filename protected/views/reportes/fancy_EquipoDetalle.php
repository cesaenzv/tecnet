<?php
	echo $this->renderPartial('_detalleMaqTemplate'); 
?>

<script type="text/javascript">	
	var urlGetmaqDetalle = '<?php echo Yii::app()->createAbsoluteUrl("Reportes/GetDetalleEquipo"); ?>';
</script>

<div class="form detalleEquipo">
	<div class="row">
		<label>Identificacion de la maquina <label id="idEquipoLbl"><?php echo $euipoId ?></label> </label>
		
		<label>Tipo Equipo 
			<?php			
				echo CHtml::dropDownList('idServicio', 'idServicio', $serviciosList,null);
			?>
		</label>		
	</div>
	
	<div class="row">
		<label>Seleccione las fechas de consulta:</label>
	</div>
	<div class="row">		
		<label>Inicio: <input type="input" id="fchID"/> </label>
		<label>Fin: <input type="input" id="fchFD"/> </label>		
	</div>

	<button id="btnGetDetalle">Obtener Detalles</button>	
</div>

<div id="TemplateContentDetalle">
	
</div>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/modules/equiDetalleModule.js'); ?>