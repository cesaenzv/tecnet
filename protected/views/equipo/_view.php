<?php
/* @var $this EquipoController */
/* @var $data Equipo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idEquipo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_idEquipo), array('view', 'id'=>$data->k_idEquipo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_nombreEquipo')); ?>:</b>
	<?php echo CHtml::encode($data->n_nombreEquipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idCliente')); ?>:</b>
	<?php echo CHtml::encode($data->k_idCliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idEspecificacion')); ?>:</b>
	<?php echo CHtml::encode($data->k_idEspecificacion); ?>
	<br />


</div>