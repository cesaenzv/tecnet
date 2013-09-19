<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Marca'=>array('index'),
	'Create',
);

?>

<h1>Crear Marca</h1>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'marca-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Campos con <span class="required">*</span> son campos requeridos.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'n_nombreMarca'); ?>
		<?php echo $form->textField($model, 'n_nombreMarca', array('size' => 50, 'maxlength' => 50)); ?>
		<?php echo $form->error($model, 'n_nombreMarca'); ?>
    </div>

    <div class="row buttons">
        <?php
        echo CHtml::ajaxSubmitButton('Guardar', $this->createUrl('marca/createFancy'), array(
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
    <script type="text/javascript">
        $("#Marca_n_nombreMarca").bind('blur', function (e) {
            $("#Marca_n_nombreMarca").val(($("#Marca_n_nombreMarca").val()).toUpperCase());
        });


    </script>
</div><!-- form -->