<?php
/* @var $this EspecificacionController */
/* @var $model Especificacion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'k_especificacion'); ?>
		<?php echo $form->textField($model,'k_especificacion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_nombreEspecificacion'); ?>
		<?php echo $form->textField($model,'n_nombreEspecificacion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'k_idTipoEquipo'); ?>
		<?php echo $form->textField($model,'k_idTipoEquipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'k_idMarca'); ?>
		<?php echo $form->textField($model,'k_idMarca'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->