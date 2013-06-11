<?php
/* @var $this ClienteController */
/* @var $model Cliente */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'k_identificacion'); ?>
		<?php echo $form->textField($model,'k_identificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_nombre'); ?>
		<?php echo $form->textField($model,'n_nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_apellido'); ?>
		<?php echo $form->textField($model,'n_apellido',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'o_direccion'); ?>
		<?php echo $form->textField($model,'o_direccion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'o_celular'); ?>
		<?php echo $form->textField($model,'o_celular',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'o_fijo'); ?>
		<?php echo $form->textField($model,'o_fijo',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'o_mail'); ?>
		<?php echo $form->textField($model,'o_mail',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'k_usuarioCrea'); ?>
		<?php echo $form->textField($model,'k_usuarioCrea'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->