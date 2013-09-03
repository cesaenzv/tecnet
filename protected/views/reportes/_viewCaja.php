<?php
	echo $this->renderPartial('_cajaTemplate'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/modules/reporteCaja.js', CClientScript::POS_HEAD);
?>
<script type="text/javascript">
	var url = '<?php echo Yii::app()->createAbsoluteUrl("Reportes/GetReporteCaja"); ?>';	
	var urlGetServicios = '<?php echo Yii::app()->createAbsoluteUrl("Reportes/GetServicios"); ?>';
</script>

<div class="config configTec" id="configContent">		
	<span>
		<label>Seleccione tipo de consulta:</label>
		<span>Ingresos por orden <input type="radio" name="cajaType" value="ingO"/> </span>
		<span>Ingresos por servicios <input type="radio" name="cajaType" value="ingS"/> </span>	
		<span>Ingresos tipo servicio <input type="radio" name="cajaType" value="ingTS"/> </span>			
	</span>
	<span id="listTipoSer">
		<select id="tipoServicio">
			<option value="mnt" selected="selected">Mantenimiento</option>
			<option value="rcg">Recargas</option>
		</select>	
	</span>
	<span  id="listServicios">
		
	</span>	
	<span>
		<label>Seleccione las fechas de consulta:</label>
		<span>Inicio: <input type="input" id="fchI"/> </span>
		<span>Fin: <input type="input" id="fchF"/> </span>	
	</span>	
</div>

<button id="consultBtn" class="button">Consultar</button>

<div id="TemplateContent">
	
</div>