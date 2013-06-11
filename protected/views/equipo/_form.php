<?php
/* @var $this EquipoController */
/* @var $model Equipo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'equipo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'n_nombreEquipo'); ?>
		<?php echo $form->textField($model,'n_nombreEquipo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'n_nombreEquipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'k_idCliente'); ?>
		<?php echo $form->textField($model,'k_idCliente'); ?>
		<?php echo $form->error($model,'k_idCliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'k_idEspecificacion'); ?>
		<?php echo $form->textField($model,'k_idEspecificacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'k_idEspecificacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->