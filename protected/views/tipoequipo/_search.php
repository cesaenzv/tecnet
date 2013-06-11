<?php
/* @var $this TipoequipoController */
/* @var $model Tipoequipo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'k_idTipo'); ?>
		<?php echo $form->textField($model,'k_idTipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_tipoEquipo'); ?>
		<?php echo $form->textField($model,'n_tipoEquipo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->