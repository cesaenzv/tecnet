<?php
/* @var $this ServicioController */
/* @var $model Servicio */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'k_idServicio'); ?>
		<?php echo $form->textField($model,'k_idServicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_nomServicio'); ?>
		<?php echo $form->textField($model,'n_nomServicio',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'v_costoServicio'); ?>
		<?php echo $form->textField($model,'v_costoServicio'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->