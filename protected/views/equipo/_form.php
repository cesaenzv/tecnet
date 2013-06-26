<?php
/* @var $this EquipoController */
/* @var $equipo Equipo */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/equipoModule.js'); 
?>
<script type="text/javascript">
	equipoModule.setUrl('<?php echo Yii::app()->createAbsoluteUrl("especificacion/getEspecificationList"); ?>');
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
		var_dump($marca['list']);
		echo $form->labelEx($marca['model'],'n_nombreMarca'); 
		$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'marca',
		    'model'=>$marca['model'],
		    'source'=>$marca['list'],
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        'minLength'=>'2',
		        'change'=>"js:function(event, ui) {
                              	if (!ui.item) {
                                	$('#marca').val('');
                              	}else{
                              		equipoModule.setMarca(ui.item);
                              	}

                            }",
		    ),
		    'htmlOptions'=>array(		        
		    	'id'=>'marca'
		    ),
		));
	?>

	<?php
		var_dump($tipoEquipo['list']); 
		echo $form->labelEx($tipoEquipo['model'],'n_tipoEquipo');
		$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'tipoequipo',
		    'model'=>$tipoEquipo['model'],
		    'source'=>$tipoEquipo['list'],
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        'minLength'=>'2',
		        'change'=>"js:function(event, ui) {
                         	if(!ui.item) {
                            	$('#tipoEquipo').val('');
                          	}else{
                          		equipoModule.setTipoEquipo(ui.item);
                            }	
                        }",
		    ),
		    'htmlOptions'=>array(
		    	'id'=>'tipoEquipo'		        
		    ),
		));
	?>	

	<div class="row">
		<?php echo $form->labelEx($especificacion,'Especificacion'); ?>
		<?php echo $form->textField($especificacion,'n_nombreEspecificacion',array('size'=>50,'maxlength'=>50, 'id'=>"especificacionInput")); ?>
		<?php echo $form->error($especificacion,'n_nombreEspecificacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($equipo->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/equipoModule.js'); 
	Yii::app()->clientScript->registerCoreScript('jquery');	
?>