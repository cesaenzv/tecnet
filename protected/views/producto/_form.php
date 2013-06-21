<?php
/* @var $this ProductoController */
/* @var $model Producto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'producto-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model,$services_product); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'n_nombreProducto'); ?>
		<?php echo $form->textField($model,'n_nombreProducto',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'n_nombreProducto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'v_costoProducto'); ?>
		<?php echo $form->textField($model,'v_costoProducto'); ?>
		<?php echo $form->error($model,'v_costoProducto'); ?>
	</div>
	
	<?php if(isset($services_product)){?>
		<div class="row">
			<?php echo $form->labelEx($services_product,'Servicio'); ?>
			<?php echo $form->dropDownList($services_product,'k_servicio', CHtml::listData($services, 'k_idServicio', 'n_nomServicio'), array('empty'=>'Seleccione Servicio'))?>
			<?php echo $form->error($services_product,'k_servicio'); ?>
		</div>
	<?php } ?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->