<?php
/* @var $this MarcaController */
/* @var $data Marca */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idMarca')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_idMarca), array('view', 'id'=>$data->k_idMarca)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_nombreMarca')); ?>:</b>
	<?php echo CHtml::encode($data->n_nombreMarca); ?>
	<br />


</div>