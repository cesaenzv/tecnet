<?php
	echo $this->renderPartial('_historialTemplate'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/modules/reporteHistorial.js', CClientScript::POS_HEAD);
?>
<script type="text/javascript">
	var url = '<?php echo Yii::app()->createAbsoluteUrl("Reportes/GetHistorial"); ?>';
</script>

<div id="config">
	<span>
		<label>Codigo Identificacion: </label>
		<input type="text" id="idConsult"/>
	</span>			
	<span>
		<label>Tipo consulta:</label>
		<span>Cliente <input type="radio" name="tipoHistorial" value="clt"/> </span>
		<span>Maquina <input type="radio" name="tipoHistorial" value="maq"/> </span>		
	</span>	
	<span  id="contentTipDoc">
		<label>Tipo documento:</label>
		<?php echo CHtml::dropDownList(null, null, array('CC'=>'CC', 'TI'=>'TI','NIT'=>'NIT','CE'=>'CE','PA'=>'PA'), array('id'=>'tipoDoc'))?>
	</span>	
	<!-- <span>
		<label>Fechas:</label>
		<span>Inicio:<input id="initDate" type="date" placeholder="dd/mm/yyyy"/></span>
		<span>Fin:<input id="endDate" type="date" placeholder="dd/mm/yyyy"/></span>
	</span>	 -->	
</div>
<button id="consultBtn" class="button">Consultar</button>

<div id="TemplateContent">
	
</div>