<?php
/* @var $this MarcaController */
/* @var $model Marca */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'marca-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'n_nombreMarca'); ?>
<?php echo $form->textField($model, 'n_nombreMarca', array('size' => 50, 'maxlength' => 50)); ?>
<?php echo $form->error($model, 'n_nombreMarca'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>
    <script type="text/javascript">
        $("#Marca_n_nombreMarca").bind('blur', function (e) {
            $("#Marca_n_nombreMarca").val(($("#Marca_n_nombreMarca").val()).toUpperCase());
        });


    </script>
</div><!-- form -->