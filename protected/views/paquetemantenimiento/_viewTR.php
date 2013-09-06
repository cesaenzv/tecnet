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
                <?php $orden=Orden::model()->findByPk($paquetesMnt["k_idOrden"]) ?>
                <span><label>NOMBRE EQUIPO: </label><?php echo $objetos->equipo["n_nombreEquipo"]; ?></span>
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
                    ?>
                </table>
                <span><label>DESCRIPCION: </label><?php echo $objetos->proceso["n_descripcion"]; ?></span>			

                <div class="botones">
                    <a href="" class="playTimer btn" id="btnPlay<?php echo $paquetesMnt["k_idPaquete"]; ?>">PLAY</a>
                    <button class="btnRetornar">Retornar</button>
                </div>			
            </div>
            <?php
        }
    }
    ?>
</div>