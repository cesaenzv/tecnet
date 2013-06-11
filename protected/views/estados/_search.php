<?php
/* @var $this EstadosController */
/* @var $model Estados */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'k_idEstado'); ?>
		<?php echo $form->textField($model,'k_idEstado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_nombreEstado'); ?>
		<?php echo $form->textField($model,'n_nombreEstado',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_descEstado'); ?>
		<?php echo $form->textField($model,'n_descEstado',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->