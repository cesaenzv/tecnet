<?php
/* @var $this DuracionController */
/* @var $model Duracion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'k_idDuracion'); ?>
		<?php echo $form->textField($model,'k_idDuracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'f_inicio'); ?>
		<?php echo $form->textField($model,'f_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'f_fin'); ?>
		<?php echo $form->textField($model,'f_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_idProceso'); ?>
		<?php echo $form->textField($model,'fk_idProceso'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->