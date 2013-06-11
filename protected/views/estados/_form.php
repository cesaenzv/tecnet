<?php
/* @var $this EstadosController */
/* @var $model Estados */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'estados-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'n_nombreEstado'); ?>
		<?php echo $form->textField($model,'n_nombreEstado',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'n_nombreEstado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_descEstado'); ?>
		<?php echo $form->textField($model,'n_descEstado',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'n_descEstado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->