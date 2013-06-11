<?php
/* @var $this EspecificacionController */
/* @var $data Especificacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_especificacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_especificacion), array('view', 'id'=>$data->k_especificacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_nombreEspecificacion')); ?>:</b>
	<?php echo CHtml::encode($data->n_nombreEspecificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idTipoEquipo')); ?>:</b>
	<?php echo CHtml::encode($data->k_idTipoEquipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idMarca')); ?>:</b>
	<?php echo CHtml::encode($data->k_idMarca); ?>
	<br />


</div>