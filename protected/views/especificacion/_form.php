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

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'k_especificacion'); ?>
		<?php echo $form->textField($model,'k_especificacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'k_especificacion'); ?>
	</div> -->

	<div class="row">
		<?php echo $form->labelEx($model,'n_nombreEspecificacion'); ?>
		<?php echo $form->textField($model,'n_nombreEspecificacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'n_nombreEspecificacion'); ?>
	</div>

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'k_idTipoEquipo'); ?>
		<?php echo $form->textField($model,'k_idTipoEquipo'); ?>
		<?php echo $form->error($model,'k_idTipoEquipo'); ?>
	</div> -->
	<?php if(isset($tipoEquipo)){?>
    	<div class="row">
	      	<?php echo $form->labelEx($tipoEquipo['model'],'Tipo Equipo'); ?>
	      	<?php echo $form->dropDownList($tipoEquipo['model'],'k_idTipo', CHtml::listData($tipoEquipo['list'], 'k_idTipo', 'n_tipoEquipo'));?>
	      	<?php echo $form->error($tipoEquipo['model'],'k_idTipo'); ?>
	    </div>
  	<?php } ?>

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'k_idMarca'); ?>
		<?php echo $form->textField($model,'k_idMarca'); ?>
		<?php echo $form->error($model,'k_idMarca'); ?>
	</div> -->

	<?php if(isset($marca)){?>
    	<div class="row">
	      	<?php echo $form->labelEx($marca['model'],'Marca'); ?>
	      	<?php echo $form->dropDownList($marca['model'],'k_idMarca', CHtml::listData($marca['list'], 'k_idMarca', 'n_nombreMarca'));?>
	      	<?php echo $form->error($marca['model'],'k_idTipo'); ?>
	    </div>
  	<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->