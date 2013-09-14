<div id="paquetesM">
    <?php
    if (isset($procesos)) {
        foreach ($procesos as $i => $proceso) {
            $objetos = $proceso->objetos;
            $paquetesMnt = $proceso->objetos->paqueteMnt;
            ?>
            <div class="paqR">
                <h3><strong>ORDEN <?php echo $paquetesMnt["k_idOrden"]; ?></strong><strong> PAQUETE <?php echo $paquetesMnt["k_idPaquete"]; ?></strong></h3>
                <!-- valores ha pasar para el tratado -->
                <input type=hidden name='idPaquete' value=<?php echo $paquetesMnt["k_idPaquete"]; ?> />
                <input type=hidden name='idProceso' value=<?php echo $objetos->proceso["k_idProceso"]; ?> />
                <input type=hidden name='idEquipo' 	value=<?php echo $objetos->equipo["k_idEquipo"]; ?> />
                <?php $orden = Orden::model()->findByPk($paquetesMnt["k_idOrden"]) ?>
                <span><label>SERIAL: </label><?php echo $objetos->equipo["n_nombreEquipo"]; ?></span>
                <span><label>ESTADO: </label><?php echo $objetos->estado["n_nombreEstado"]; ?></span>
                <span><label>FECHA INGRESO: </label><?php echo $orden["fchIngreso"]; ?></span>
                <div class="especificaciones">
                    <h4>ESPECIFICACION</h4>
                    <span><label>TIPO EQUIPO: </label><?php echo $objetos->especificacion["k_idTipoEquipo"]["n_tipoEquipo"]; ?></span>
                    <span><label>MARCA: </label><?php echo $objetos->especificacion["k_idMarca"]["n_nombreMarca"]; ?></span>
                    <span><label>REFERENCIA :</label><?php echo $objetos->especificacion["n_nombreEspecificacion"]; ?></span>
                </div>
                <table>
                    <?php
                    $proceso = Proceso::model()->findAll("fk_idPaqueteManenimiento=:paquete", array(":paquete" => $paquetesMnt["k_idPaquete"]));
                    echo "<tr><th>Servicio</th><th>Items</th></tr>";
                    foreach ($proceso as $var) {
                        $procesoServicio = Procesoservicio::model()->find("k_idProceso=:k_idProceso", array(":k_idProceso" => $var["k_idProceso"]));
                        $servicio = Servicio::model()->findByPk($procesoServicio["k_idServicio"]);
                        echo "<tr><td>" . $servicio["n_nomServicio"] . "</td>";
                        $productoServicio = Servicioproducto::model()->findAll("k_servicio=:k_servicio", array(":k_servicio" => $servicio["k_idServicio"]));
                        $items = "";
                        foreach ($productoServicio as $prodserv) {
                            $prod = Producto::model()->findByPk($prodserv["k_producto"]);
                            $items = $items . $prod['n_nombreProducto'] . "<br/>";
                        }
                        echo "<td>" . $items . "</td></tr>";
                    }
                    $paqueteMantenModel=  Paquetematenimiento::model()->find("k_idPaquete=:paquete AND k_idOrden=:orden",array(":paquete"=>$paquetesMnt["k_idPaquete"],":orden"=>$paquetesMnt["k_idOrden"]));
                    $estado=$paqueteMantenModel->fk_idEstado;
                    ?>
                </table>
                <span><label>DESCRIPCION: </label><?php echo $objetos->proceso["n_descripcion"]; ?></span>			

                <div class="botones">
                    <a class="play" <?php if($estado==2){ ?>style="display: none;"<?php } ?> id="play_<?php echo $paquetesMnt["k_idPaquete"]; ?>" href="javascript:void(0);" onclick="play(<?php echo $paquetesMnt["k_idPaquete"]; ?>,<?php echo $paquetesMnt["k_idOrden"]; ?>)"><image src="<?php echo Yii::app()->request->baseUrl; ?>/img/playBtn.png" width="30" height="30"/></a>
                    <a class="pause" <?php if($estado==1){ ?>style="display: none;"<?php } ?> id="pause_<?php echo $paquetesMnt["k_idPaquete"]; ?>" href="javascript:void(0);" onclick="pause(<?php echo $paquetesMnt["k_idPaquete"]; ?>,<?php echo $paquetesMnt["k_idOrden"]; ?>)"><image src="<?php echo Yii::app()->request->baseUrl; ?>/img/pause.jpg" width="30" height="30"/></a>
                    <a class="stop" <?php if($estado==1){ ?>style="display: none;"<?php } ?> id="stop_<?php echo $paquetesMnt["k_idPaquete"]; ?>" href="javascript:void(0);" onclick="stop(<?php echo $paquetesMnt["k_idPaquete"]; ?>,<?php echo $paquetesMnt["k_idOrden"]; ?>)"><image src="<?php echo Yii::app()->request->baseUrl; ?>/img/stop.jpg" width="30" height="30"/></a>
                    <a class="back" id="back_<?php echo $paquetesMnt["k_idPaquete"]; ?>" href="javascript:void(0);" onclick="back(<?php echo $paquetesMnt["k_idPaquete"]; ?>,<?php echo $paquetesMnt["k_idOrden"]; ?>)"><image src="<?php echo Yii::app()->request->baseUrl; ?>/img/back.jpg" width="30" height="30"/></a>
                </div>			
            </div>
            <?php
        }
    }
    ?>
</div>
<script type="text/javascript">
    play = function(id, orden){
        var mensaje="¿Esta seguro que desea iniciar la actividad?";
        if(confirm(mensaje)){
            $.ajax({
                type: "POST",
                url: "../PaqueteMantenimiento/play/"+id,
                data: "orden="+orden,
                success: function(response){
                    if(response.status.toUpperCase()=="OK"){
                        $("#play_"+response.id).hide();
                        $("#pause_"+response.id).show();
                        $("#stop_"+response.id).show();
                    }
                    alert(response.message);
                },
                dataType: 'json'
            });
        }
    }
    pause = function(id, orden){
        var mensaje="¿Esta seguro que desea detener la actividad?";
        if(confirm(mensaje)){
            $.ajax({
                type: "POST",
                url: "../PaqueteMantenimiento/pause/"+id,
                data: "orden="+orden,
                success: function(response){
                    if(response.status.toUpperCase()=="OK"){
                        $("#play_"+response.id).show();
                        $("#pause_"+response.id).hide();
                        $("#stop_"+response.id).hide();
                    }
                    alert(response.message);
                },
                dataType: 'json'
            });
        }
    }
    stop = function(id, orden){
        var mensaje="¿Esta seguro que desea finalizar la actividad?";
        if(confirm(mensaje)){
            $.ajax({
                type: "POST",
                url: "../PaqueteMantenimiento/stop/"+id,
                data: "orden="+orden,
                success: function(response){
                    if(response.status.toUpperCase()=="OK"){
                        location.reload();
                    }
                    alert(response.message);
                },
                dataType: 'json'
            });
        }
    }
    back = function(id, orden){
        var mensaje="¿Esta seguro que desea devolver la actividad?";
        if(confirm(mensaje)){
            $.ajax({
                type: "POST",
                url: "../PaqueteMantenimiento/back/"+id,
                data: "orden="+orden,
                success: function(response){
                    if(response.status.toUpperCase()=="OK"){
                        location.reload();
                    }
                    alert(response.message);
                },
                dataType: 'json'
            });
        }
    }
</script>