<?php
/* @var $this EquipoController */
/* @var $model Equipo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'k_idEquipo'); ?>
		<?php echo $form->textField($model,'k_idEquipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_nombreEquipo'); ?>
		<?php echo $form->textField($model,'n_nombreEquipo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'k_idCliente'); ?>
		<?php echo $form->textField($model,'k_idCliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'k_idEspecificacion'); ?>
		<?php echo $form->textField($model,'k_idEspecificacion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->