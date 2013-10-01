<?php
/* @var $this ServicioController */
/* @var $model Servicio */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicio-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'n_nomServicio'); ?>
		<?php echo $form->textField($model,'n_nomServicio',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'n_nomServicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'v_costoServicio'); ?>
		<?php echo $form->textField($model,'v_costoServicio'); ?>
		<?php echo $form->error($model,'v_costoServicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'v_costoServicioTecnico'); ?>
		<?php echo $form->textField($model,'v_costoServicioTecnico'); ?>
		<?php echo $form->error($model,'v_costoServicioTecnico'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_tipoServicio'); ?>
		<?php echo $form->dropDownList($model, 'n_tipoServicio', array('M'=>'Mantenimiento', 'R'=>'Recarga','T'=>'Toner'));?>
		<?php echo $form->error($model,'n_tipoServicio'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->