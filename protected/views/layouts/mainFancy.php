<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/Styles.css" />
        <?php
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/handlebars.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.json-2.4.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/handlebars.js');
        Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/ui.jqgrid.css');
        Yii::app()->getClientScript()->registerCssFile('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/grid.locale-es.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.ui.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.jqGrid.src.js', CClientScript::POS_HEAD);
        ?>



        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div style="width: 380px;">
            <?php echo $content; ?>
        </div>
    </body>
</html>