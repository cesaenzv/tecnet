<?php
/* @var $this OrdenController */
/* @var $data Orden */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idOrden')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_idOrden), array('view', 'id'=>$data->k_idOrden)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idUsuario')); ?>:</b>
	<?php echo CHtml::encode($data->k_idUsuario); ?>
	<br />


</div>