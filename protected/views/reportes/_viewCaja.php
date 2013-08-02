<?php
	echo $this->renderPartial('_tecnicosTemplate'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/modules/reporteTecnicos.js', CClientScript::POS_HEAD);
?>
<script type="text/javascript">
	var url = '<?php echo Yii::app()->createAbsoluteUrl("Reportes/GetReporteCaja"); ?>';	
</script>

<div class="config" id="configContent">		

		
</div>

<button id="consultBtn" class="button">Consultar</button>

<div id="cajaContent">
	
</div>