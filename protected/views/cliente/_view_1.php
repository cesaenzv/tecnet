<?php
/* @var $this ClienteController */
/* @var $data Cliente */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_identificacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_identificacion), array('view', 'id'=>$data->k_identificacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->n_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_apellido')); ?>:</b>
	<?php echo CHtml::encode($data->n_apellido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('o_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->o_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('o_celular')); ?>:</b>
	<?php echo CHtml::encode($data->o_celular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('o_fijo')); ?>:</b>
	<?php echo CHtml::encode($data->o_fijo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('o_mail')); ?>:</b>
	<?php echo CHtml::encode($data->o_mail); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('k_usuarioCrea')); ?>:</b>
	<?php echo CHtml::encode($data->k_usuarioCrea); ?>
	<br />

	*/ ?>

</div>