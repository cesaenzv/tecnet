<?php
/* @var $this ServicioController */
/* @var $data Servicio */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idServicio')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_idServicio), array('view', 'id'=>$data->k_idServicio)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_nomServicio')); ?>:</b>
	<?php echo CHtml::encode($data->n_nomServicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('v_costoServicio')); ?>:</b>
	<?php echo CHtml::encode($data->v_costoServicio); ?>
	<br />


</div>