<?php
/* @var $this OrdenController */
/* @var $model Orden */
/* @var $form CActiveForm */



echo $this->renderPartial('_clientTemplate');
?>
<script type="text/javascript">
	
    var	searchClientUrl = '<?php echo Yii::app()->createAbsoluteUrl("Cliente/SearchClient"); ?>';
    var	createEquipoGridUrl = '<?php echo Yii::app()->createAbsoluteUrl("Cliente/GetEquipoGrid"); ?>';
    var urlCrearEquipo = '<?php echo Yii::app()->createAbsoluteUrl("equipo/CreateEOrden"); ?>';
    var url = '<?php echo Yii::app()->createAbsoluteUrl("equipo/CreateEOrdenView"); ?>';

</script>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'orden-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'k_idUsuario'); ?>
<?php echo $form->textField($model, 'k_idUsuario'); ?>
<?php echo $form->error($model, 'k_idUsuario'); ?>
        <select id = "typeDocument" required>
            <option value = "CC">CC</option>
            <option value = "NIT">NIT</option>       
            <option value = "TI">TI</option>       
            <option value = "CE">CE</option>       
            <option value = "PA">PA</option>       
        </select>
        <a id="searchClient"></a>
    </div>

    <div id="clientData"></div>
    <table id="equiposGrid"></table>	
    <div id="pagerEquipoGrid"></div>

    <a href='<?php
echo Yii::app()->createAbsoluteUrl("equipo/CreateEOrdenView/");
?>' id="callViewCrearEquipo" class="link-fancy"></a>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/modules/orderModule.js'); ?>

