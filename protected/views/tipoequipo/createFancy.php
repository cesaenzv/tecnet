<?php
$this->breadcrumbs=array(
	'Tipo Equipo'=>array('index'),
	'Create',
);

?>

<h1>Crear Tipo Equipo</h1>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipoequipo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son campos obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'n_tipoEquipo'); ?>
		<?php echo $form->textField($model,'n_tipoEquipo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'n_tipoEquipo'); ?>
	</div>

	<div class="row buttons">
        <?php
        echo CHtml::ajaxSubmitButton('Guardar', $this->createUrl('tipoequipo/createFancy'), array(
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