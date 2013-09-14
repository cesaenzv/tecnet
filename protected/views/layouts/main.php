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
        // MULTISELECTOR
        Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/multi-select.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.multi-select.js', CClientScript::POS_HEAD);
        ?>

        <script type="text/javascript">
            //Muestra un mensaje
            function AlertUI(title, text, onClose) {
                $("select").hide();
           //     $("#dialog-message").dialog("destroy");
                $("#dialog-message").attr("title", title);
                $("#dialog-message-text").html(text);

                $("#dialog-message").dialog({
                    modal: true,
                    resizable: false,
                    zIndex:5000000,
                    buttons: {
                        Ok: function () {
                            $(this).dialog('close');
                        }
                    },
                    close: function (event, ui) {
                        $("select").show();
                        if (onClose != undefined && onClose != null) {
                            onClose();
                        }
                    }
                });
            }
            //Muestra un mensaje tipo Confirm
            function ConfirmUI(title, text, onContinuar) {
                $("select").hide();
                $("#dialog-message").attr("title", title);
                $("#dialog-message-text").html(text);
                //$("#dialog").dialog("destroy");

                $("#dialog-message").dialog({
                    resizable: false,
                    modal: true,
                    buttons: {
                        'Continuar': function () {
                            $(this).dialog('close');
                            onContinuar();
                        },
                        'Cancelar': function () {
                            $(this).dialog('close');
                        }
                    },
                    close: function (event, ui) {
                        $("select").show();
                    }
                });
            }
        </script>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <div id="dialog-message">
                <div id="dialog-message-text"></div>
            </div>

            <div id="mainmenu">
                <?php
                $temp = new AccessDataRol();
                $this->widget('application.extensions.mbmenu.MbMenu', array(
                    'items' => $temp->getItems(),
                ));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by TECNET.<br/>
                All Rights Reserved.<br/>
                powered by CESVDMOP
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>