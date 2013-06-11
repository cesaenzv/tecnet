<?php
/* @var $this EspecificacionController */
/* @var $model Especificacion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'especificacion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'k_especificacion'); ?>
		<?php echo $form->textField($model,'k_especificacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'k_especificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_nombreEspecificacion'); ?>
		<?php echo $form->textField($model,'n_nombreEspecificacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'n_nombreEspecificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'k_idTipoEquipo'); ?>
		<?php echo $form->textField($model,'k_idTipoEquipo'); ?>
		<?php echo $form->error($model,'k_idTipoEquipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'k_idMarca'); ?>
		<?php echo $form->textField($model,'k_idMarca'); ?>
		<?php echo $form->error($model,'k_idMarca'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->