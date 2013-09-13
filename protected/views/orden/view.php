<h1>Visualizacion Orden #<span id="k_idOrden" ><?php echo $model->k_idOrden; ?></span></h1>

<?php if(isset($pdf) && $pdf == 1):?>
    <div style="text-align:center">
        <h2>SERVICIO TÉCNICO ESPECIALIZADO</h2>
        <h3>- Tels 8633287 - 8634101 Ext: 105 / Cel: 3138093917 -</h3>
    </div>

    <div style="border: 1px solid rgb(0, 0, 0); width: 30%;">
        <span>Orden: <?php echo $model->k_idOrden; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span>Fecha: <?php echo $model->fchIngreso; ?></span>
    </div>
    <br/>
    <div style="border: 1px solid rgb(0, 0, 0);">
        <span>Cliente:</span><br/>
        <span>Nombre: <?php echo $datosCliente->n_nombre . " " . $datosCliente->n_apellido; ?></span><br/>
        <span>Direccion: <?php echo $datosCliente->o_direccion; ?></span><br/>
        <span>Telefonos: <?php echo $datosCliente->o_celular . " - " . $datosCliente->o_fijo; ?></span><br/>
    </div>
    <?php foreach ($paquetes as $paq): ?>
        <br/>
        <div style="border: 1px solid rgb(0, 0, 0);">
            <span>Equipo:</span><br/>
            <span>Nro. de identificacion: <?php echo $paq["equipo"]["k_idEquipo"]; ?></span><br/>
            <span>Nro. de serie: <?php echo $paq["equipo"]["n_nombreEquipo"]; ?></span><br/>
            <?php
            $equipoModel = Equipo::model()->findByPk($paq["equipo"]["k_idEquipo"]);
            $especificacionModel = Especificacion::model()->findByPk($equipoModel->k_idEspecificacion);
            $marcaModel = Marca::model()->findByPk($especificacionModel->k_idMarca);
            $paqueteMantenimientoModel = Paquetematenimiento::model()->find("k_idOrden=:idOrden AND k_idEquipo=:idEquipo", array(":idOrden" => $model->k_idOrden, ":idEquipo" => $paq["equipo"]["k_idEquipo"]));
            $procesoModel = Proceso::model()->findAll("fk_idPaqueteManenimiento=:paqMant", array(":paqMant" => $paqueteMantenimientoModel->k_idPaquete));
            //$arreglo=array();
            $arregloInterno = array();
            foreach ($procesoModel as $proc) {
                $procesoServicio = Procesoservicio::model()->findAll("k_idProceso=:procesoServicio", array(":procesoServicio" => $proc->k_idProceso));
                foreach ($procesoServicio as $procServ) {
                    $servicio = Servicio::model()->findByPk($procServ->k_idServicio);
                    $arregloInterno[] = $servicio->n_nomServicio;
                }
            }
            ?>
            <span>Marca: <?php echo $marcaModel->n_nombreMarca; ?></span><br/>
            <span>Modelo: <?php echo $especificacionModel->n_nombreEspecificacion; ?></span><br/>
            <span>Servicio: 
                <?php
                foreach ($arregloInterno as $val) {
                    echo $val . "<br/>";
                }
                ?></span><br/>
            <span>Accesorios: <?php echo $paqueteMantenimientoModel->n_accesorios; ?></span><br/>
            <span>Garantia: <?php echo $paqueteMantenimientoModel->q_diasGarantia; ?> días despues de la fecha de entrega al cliente</span><br/>
        </div>
    <?php endforeach; ?>
<?php elseif(isset($pdf) && $pdf == 0): ?>
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
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.json-2.4.js');
    Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/ui.jqgrid.css');
    Yii::app()->getClientScript()->registerCssFile('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.ui.js', CClientScript::POS_HEAD);

    echo $this->renderPartial('_view', array(  'model' => $model, 
                        'estado' =>$estado, 
                        'paquetes' => $paquetes));

    ?>

    <br/>
    <div name="btnImprimir" id="btnImprimir">Imprimir</div>
    <script type="text/javascript">
        $(function(){
            $("#btnImprimir").button().click(function(){
                window.open('<?php echo Yii::app()->createUrl("orden/viewPDF", array("id" => $model->k_idOrden)); ?>', '_blank', 'height=600,width=850,toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no');
            });
        });
    </script>
<?php endif; ?>

