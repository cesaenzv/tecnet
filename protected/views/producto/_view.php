<?php
/* @var $this ProductoController */
/* @var $data Producto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idProducto')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_idProducto), array('view', 'id'=>$data->k_idProducto)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_nombreProducto')); ?>:</b>
	<?php echo CHtml::encode($data->n_nombreProducto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('v_costoProducto')); ?>:</b>
	<?php echo CHtml::encode($data->v_costoProducto); ?>
	<br />


</div>