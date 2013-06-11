<?php
/* @var $this ProcesoController */
/* @var $model Proceso */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'k_idProceso'); ?>
		<?php echo $form->textField($model,'k_idProceso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'k_idCreador'); ?>
		<?php echo $form->textField($model,'k_idCreador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PaqueteMatenimiento_k_idPaquete'); ?>
		<?php echo $form->textField($model,'PaqueteMatenimiento_k_idPaquete'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->