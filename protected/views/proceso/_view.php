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

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_idEstado')); ?>:</b>
	<?php echo CHtml::encode($data->fk_idEstado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->n_descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('o_flagLeido')); ?>:</b>
	<?php echo CHtml::encode($data->o_flagLeido); ?>
	<br />


</div>