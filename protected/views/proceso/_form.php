<?php
/* @var $this ProcesoController */
/* @var $model Proceso */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'proceso-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'k_idCreador'); ?>
		<?php echo $form->textField($model,'k_idCreador'); ?>
		<?php echo $form->error($model,'k_idCreador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PaqueteMatenimiento_k_idPaquete'); ?>
		<?php echo $form->textField($model,'PaqueteMatenimiento_k_idPaquete'); ?>
		<?php echo $form->error($model,'PaqueteMatenimiento_k_idPaquete'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->