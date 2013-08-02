<?php
	echo $this->renderPartial('_tecnicosTemplate'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/modules/reporteTecnicos.js', CClientScript::POS_HEAD);
?>
<script type="text/javascript">
	var url = '<?php echo Yii::app()->createAbsoluteUrl("Reportes/GetReporteCaja"); ?>';	
</script>

<div class="config" id="configContent">		
	<span>
		<label>Seleccione tipo de consulta:</label>
		<span>Ingresos por orden <input type="radio" name="cajaType" value="ingO"/> </span>
		<span>Costos por servicios <input type="radio" name="cajaType" value="cstS"/> </span>	
		<span>Costos por productos<input type="radio" name="cajaType" value="serP"/></span>
	</span>
	<span>
		<label>Seleccione las fechas de consulta:</label>
		<span>Inicio: <input type="input" id="fchI"/> </span>
		<span>Fin: <input type="input" id="fchF"/> </span>	
	</span>	
</div>

<button id="consultBtn" class="button">Consultar</button>

<div id="cajaContent">
	
</div>