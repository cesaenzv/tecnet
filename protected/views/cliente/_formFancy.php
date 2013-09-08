<?php
/* @var $this ClienteController */
/* @var $model Cliente */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'cliente-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'k_identificacion'); ?>
        <?php echo $form->textField($model, 'k_identificacion', array('readonly' => true)); ?>
        <?php echo $form->error($model, 'k_identificacion'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'i_nit'); ?>
        <?php echo $form->dropDownList($model, 'i_nit', array('CC' => 'CC', 'TI' => 'TI', 'NIT' => 'NIT', 'CE' => 'CE', 'PA' => 'PA')); ?>
        <?php echo $form->error($model, 'i_nit'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'n_nombre'); ?>
        <?php echo $form->textField($model, 'n_nombre', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'n_nombre'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'n_apellido'); ?>
        <?php echo $form->textField($model, 'n_apellido', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'n_apellido'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'o_direccion'); ?>
        <?php echo $form->textField($model, 'o_direccion', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'o_direccion'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'o_celular'); ?>
        <?php echo $form->textField($model, 'o_celular', array('size' => 15, 'maxlength' => 15)); ?>
        <?php echo $form->error($model, 'o_celular'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'o_fijo'); ?>
        <?php echo $form->textField($model, 'o_fijo', array('size' => 15, 'maxlength' => 15)); ?>
        <?php echo $form->error($model, 'o_fijo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'o_mail'); ?>
        <?php echo $form->textField($model, 'o_mail', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'o_mail'); ?>
    </div>

    <div class="row buttons">
        <?php
        echo CHtml::ajaxSubmitButton('Guardar', $this->createUrl('cliente/createFancy'), array(
            'dataType' => 'json',
            'type' => 'post',
            'success' => 'function(data) {
                         alert(data);
                         $("#dialog-iframe").dialog("close");
                    }'
                )
        );
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->