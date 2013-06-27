<?php
/* @var $this ProductoController */
/* @var $model Producto */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'producto-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'n_nombreProducto'); ?>
        <?php echo $form->textField($model, 'n_nombreProducto', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'n_nombreProducto'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'v_costoProducto'); ?>
        <?php echo $form->textField($model, 'v_costoProducto'); ?>
        <?php echo $form->error($model, 'v_costoProducto'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>
    <script type="text/javascript">
        $("#Producto_n_nombreProducto").bind('blur', function (e) {
            $("#Producto_n_nombreProducto").val(($("#Producto_n_nombreProducto").val()).toUpperCase());
        });


    </script>
</div><!-- form -->