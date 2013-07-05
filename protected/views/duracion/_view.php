<?php
/* @var $this DuracionController */
/* @var $data Duracion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('k_idDuracion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->k_idDuracion), array('view', 'id'=>$data->k_idDuracion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('f_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->f_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('f_fin')); ?>:</b>
	<?php echo CHtml::encode($data->f_fin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_idProceso')); ?>:</b>
	<?php echo CHtml::encode($data->fk_idProceso); ?>
	<br />


</div>