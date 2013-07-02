<?php
/* @var $this ProcesoController */
/* @var $model Proceso */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'k_idProceso'); ?>
		<?php echo $form->textField($model,'k_idProceso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'k_idCreador'); ?>
		<?php echo $form->textField($model,'k_idCreador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_idEstado'); ?>
		<?php echo $form->textField($model,'fk_idEstado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_descripcion'); ?>
		<?php echo $form->textArea($model,'n_descripcion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'o_flagLeido'); ?>
		<?php echo $form->textField($model,'o_flagLeido'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->