<?php
/* @var $this ServicioController */
/* @var $model Servicio */
/* @var $form CActiveForm */

Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/fancybox/jquery.fancybox.css?v=2.1.5');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/libs/jquery.fancybox.js?v=2.1.5', CClientScript::POS_HEAD);
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/ui.jqgrid.css');
Yii::app()->getClientScript()->registerCssFile('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
Yii::app()->clientScript->registerScriptFile('http://code.jquery.com/ui/1.10.3/jquery-ui.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/libs/grid.locale-es.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/libs/jquery.jqGrid.src.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('helloscript',"init();",CClientScript::POS_READY);

?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'servicio-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'n_nomServicio'); ?>
        <?php echo $form->textField($model, 'n_nomServicio', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'n_nomServicio'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'v_costoServicio'); ?>
        <?php echo $form->textField($model, 'v_costoServicio'); ?>
        <?php echo $form->error($model, 'v_costoServicio'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>
    <script type="text/javascript">
        $("#Servicio_n_nomServicio").bind('blur', function (e) {
            $("#Servicio_n_nomServicio").val(($("#Servicio_n_nomServicio").val()).toUpperCase());
        });


    </script>
</div><!-- form -->