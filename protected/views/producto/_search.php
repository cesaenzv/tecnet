<?php
/* @var $this ProductoController */
/* @var $model Producto */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'k_idProducto'); ?>
		<?php echo $form->textField($model,'k_idProducto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_nombreProducto'); ?>
		<?php echo $form->textField($model,'n_nombreProducto',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'v_costoProducto'); ?>
		<?php echo $form->textField($model,'v_costoProducto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->