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
		<?php echo $form->labelEx($model,'fk_idEstado'); ?>
		<?php echo $form->textField($model,'fk_idEstado'); ?>
		<?php echo $form->error($model,'fk_idEstado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_descripcion'); ?>
		<?php echo $form->textArea($model,'n_descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'n_descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_flagLeido'); ?>
		<?php echo $form->textField($model,'o_flagLeido'); ?>
		<?php echo $form->error($model,'o_flagLeido'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->