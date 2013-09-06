<?php
/* @var $this EquipoController */
/* @var $equipo Equipo */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/modules/equipoModule.js"); 
?>

<script type="text/javascript">
	var url = '<?php echo Yii::app()->createAbsoluteUrl("especificacion/getEspecificationList"); ?>';
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'equipo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($equipo, $tipoEquipo['model'], $marca['model'],$especificacion); ?>	

	<div class="row">
		<?php echo $form->labelEx($equipo,'k_idCliente'); ?>
		<?php echo $form->textField($equipo,'k_idCliente'); ?>
		<?php echo $form->error($equipo,'k_idCliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($equipo,'n_nombreEquipo'); ?>
		<?php echo $form->textField($equipo,'n_nombreEquipo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($equipo,'n_nombreEquipo'); ?>
	</div>

	<?php
		echo $form->labelEx($tipoEquipo['model'],'n_tipoEquipo');
		echo $form->dropDownList($tipoEquipo['model'], 'n_tipoEquipo', $tipoEquipo['list'],null);
                
		echo $form->labelEx($marca['model'],'n_nombreMarca');
		echo $form->dropDownList($marca['model'], 'n_nombreMarca', $marca['list'],null);


	?>	

	<div class="row">
		<?php echo $form->labelEx($especificacion,'Modelo'); ?>
		<?php echo $form->textField($especificacion,'n_nombreEspecificacion',array('size'=>50,'maxlength'=>50, 'id'=>"especificacionInput")); ?>
		<?php echo $form->error($especificacion,'n_nombreEspecificacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($equipo->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
