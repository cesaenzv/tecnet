<?php
	echo $this->renderPartial('_tecnicosTemplate'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/modules/reporteTecnicos.js', CClientScript::POS_HEAD);
?>
<script type="text/javascript">
	var url = '<?php echo Yii::app()->createAbsoluteUrl("Reportes/GetTecnicoInforme"); ?>';
	var urlGetTecs = '<?php echo Yii::app()->createAbsoluteUrl("Reportes/GetTecnicos"); ?>';
</script>

<div id="config">		
	<span>
		<label>Seleccione tipo de tecnico:</label>
		<span>Mantenimiento <input type="radio" name="tipoTec" value="mnt"/> </span>
		<span>Recargas <input type="radio" name="tipoTec" value="rcg"/> </span>		
	</span>
	<span  id="listTecnicos">
		
	</span>	
	<span>
		<label>Seleccione tipo consulta:</label>
	</span>
	
		
</div>
<button id="consultBtn" class="button">Consultar</button>

<<div id="tecnicoContent">
	
</div>