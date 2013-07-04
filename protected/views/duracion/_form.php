<?php
/* @var $this DuracionController */
/* @var $model Duracion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'duracion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'f_inicio'); ?>
		<?php echo $form->textField($model,'f_inicio'); ?>
		<?php echo $form->error($model,'f_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'f_fin'); ?>
		<?php echo $form->textField($model,'f_fin'); ?>
		<?php echo $form->error($model,'f_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_idProceso'); ?>
		<?php echo $form->textField($model,'fk_idProceso'); ?>
		<?php echo $form->error($model,'fk_idProceso'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->