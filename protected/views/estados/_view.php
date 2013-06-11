<?php
/* @var $this EstadosController */
/* @var $data Estados */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idEstado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_idEstado), array('view', 'id'=>$data->k_idEstado)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_nombreEstado')); ?>:</b>
	<?php echo CHtml::encode($data->n_nombreEstado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_descEstado')); ?>:</b>
	<?php echo CHtml::encode($data->n_descEstado); ?>
	<br />


</div>