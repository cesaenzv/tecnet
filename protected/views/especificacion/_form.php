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

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php 
			echo $form->labelEx($model,'n_nombreEspecificacion'); 
		 	echo $form->textField($model,'n_nombreEspecificacion',array('size'=>50,'maxlength'=>50)); 
			echo $form->error($model,'n_nombreEspecificacion'); 
		?>
	</div>

	<?php if(isset($tipoEquipo)):?>
    	<div class="row">
	      	<?php 
	      	echo $form->labelEx($tipoEquipo['model'],'Tipo Equipo'); 
	      	 echo $form->dropDownList($tipoEquipo['model'],'k_idTipo', CHtml::listData($tipoEquipo['list'], 'k_idTipo', 'n_tipoEquipo'));
	      	 echo $form->error($tipoEquipo['model'],'k_idTipo'); ?>
	    </div>
  	<?php endif; ?>

	<?php if(isset($marca)):?>
    	<div class="row">
	      	<?php 
		      	echo $form->labelEx($marca['model'],'Marca'); 
		      	echo $form->dropDownList($marca['model'],'k_idMarca', CHtml::listData($marca['list'], 'k_idMarca', 'n_nombreMarca'));
		      	echo $form->error($marca['model'],'k_idTipo'); 
		    ?>
	    </div>
  	<?php endif;?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->