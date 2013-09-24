<?php
$this->breadcrumbs=array(
	'Modelo'=>array('index'),
	'Create',
);

?>

<h1>Crear Modelo</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'especificacion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'n_nombreEspecificacion'); ?>
		<?php echo $form->textField($model,'n_nombreEspecificacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'n_nombreEspecificacion'); ?>
	</div>

	<?php if(isset($tipoEquipo)){?>
    	<div class="row">
	      	<?php echo $form->labelEx($tipoEquipo['model'],'Tipo Equipo'); ?>
	      	<?php echo $form->dropDownList($tipoEquipo['model'],'k_idTipo', CHtml::listData($tipoEquipo['list'], 'k_idTipo', 'n_tipoEquipo'));?>
	      	<?php echo $form->error($tipoEquipo['model'],'k_idTipo'); ?>
	    </div>
  	<?php } ?>

	<?php if(isset($marca)){?>
    	<div class="row">
	      	<?php echo $form->labelEx($marca['model'],'Marca'); ?>
	      	<?php echo $form->dropDownList($marca['model'],'k_idMarca', CHtml::listData($marca['list'], 'k_idMarca', 'n_nombreMarca'));?>
	      	<?php echo $form->error($marca['model'],'k_idTipo'); ?>
	    </div>
  	<?php } ?>

	<div class="row buttons">
        <?php
        echo CHtml::ajaxSubmitButton('Guardar', $this->createUrl('especificacion/createFancy'), array(
            'dataType' => 'json',
            'type' => 'post',
            'success' => 'function(data) {
                            if(data.status == 1){
                                alert(data.msg);
                                console.log($(window).close());
                            }

                    }'
                )
        );
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->