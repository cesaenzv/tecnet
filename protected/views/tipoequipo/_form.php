<?php
/* @var $this TipoequipoController */
/* @var $model Tipoequipo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipoequipo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'n_tipoEquipo'); ?>
		<?php echo $form->textField($model,'n_tipoEquipo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'n_tipoEquipo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->