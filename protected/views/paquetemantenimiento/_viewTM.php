<div id="paquetesM">
	<?php
	if(isset($procesos)){ 
		foreach ($procesos as $i => $proceso) {
			$objetos = $proceso->objetos;
			$paquetesMnt = $proceso->objetos->paqueteMnt;
	?>
		<div class="paqR">
			<h3><strong>PAQUETE <?php echo $paquetesMnt["k_idPaquete"];?></strong></h3>
			<!-- valores ha pasar para el tratado -->
			<input type=hidden name='idPaquete' value=<?php echo $paquetesMnt["k_idPaquete"];?>/>
			<input type=hidden name='idProceso' value=<?php echo $objetos->proceso["k_idProceso"];?>/>
			<input type=hidden name='idEquipo' 	value=<?php echo $objetos->equipo["k_idEquipo"];?>/>

			<span><label>DESCRIPCION: </label><?php echo $objetos->proceso["n_descripcion"];?></span>			
			<span><label>NOMBRE EQUIPO: </label><?php echo $objetos->equipo["n_nombreEquipo"];?></span>
			<span><label>ESTADO: </label><?php echo $objetos->estado["n_nombreEstado"];?></span>
			<div class="especificaciones">
				<h4>ESPECIFICACION</h4>
				<span><label>TIPO EQUIPO: </label><?php echo $objetos->especificacion["k_idTipoEquipo"]["n_tipoEquipo"];?></span>
				<span><label>MARCA: </label><?php echo $objetos->especificacion["k_idMarca"]["n_nombreMarca"];?></span>
				<span><label>REFERENCIA :</label><?php echo $objetos->especificacion["n_nombreEspecificacion"];?></span>
			</div>
			<div class="botones">
				<button class="btnTratarR">Tratar</button>
				<button class="btnRetornar">Retornar</button>
			</div>			
		</div>
	<?php 
		}
	}
	?>
</div>