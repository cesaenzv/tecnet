<?php
	echo $this->renderPartial('_tecnicosTemplate'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/modules/reporteTecnicos.js', CClientScript::POS_HEAD);
?>
<script type="text/javascript">
	var url = '<?php echo Yii::app()->createAbsoluteUrl("Reportes/GetTecnicoInforme"); ?>';
	var urlGetTecs = '<?php echo Yii::app()->createAbsoluteUrl("Reportes/GetTecnicos"); ?>';
</script>

<div class="config configTec" id="configContent">		
	<span>
		<label>Seleccione tipo de tecnico:</label>
		<span>Mantenimiento <input type="radio" name="tecType" value="mnt"/> </span>
		<span>Recargas <input type="radio" name="tecType" value="rcg"/> </span>		
	</span>
	<span  id="listTecnicos">
		
	</span>	
	<span>
		<label>Seleccione tipo consulta:</label>
		<span>Maquinas Tecnico<input type="radio" name="reportType" value="maqTec"/> </span>
		<span>Facturacion<input type="radio" name="reportType" value="fct"/> </span>	
	</span>
	<span id="fechas">
		<label>Seleccione las fechas de consulta:</label>
		<span>Inicio: <input type="input" id="fchI"/> </span>
		<span>Fin: <input type="input" id="fchF"/> </span>	
	</span>	
		
</div>
<button id="consultBtn" class="button">Consultar</button>

<div id="tecnicoContent">
	
</div>