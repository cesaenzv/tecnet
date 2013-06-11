<?php
/* @var $this ProcesoController */
/* @var $data Proceso */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idProceso')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_idProceso), array('view', 'id'=>$data->k_idProceso)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idCreador')); ?>:</b>
	<?php echo CHtml::encode($data->k_idCreador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PaqueteMatenimiento_k_idPaquete')); ?>:</b>
	<?php echo CHtml::encode($data->PaqueteMatenimiento_k_idPaquete); ?>
	<br />


</div>