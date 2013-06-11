<?php
/* @var $this TipoequipoController */
/* @var $data Tipoequipo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idTipo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_idTipo), array('view', 'id'=>$data->k_idTipo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_tipoEquipo')); ?>:</b>
	<?php echo CHtml::encode($data->n_tipoEquipo); ?>
	<br />


</div>