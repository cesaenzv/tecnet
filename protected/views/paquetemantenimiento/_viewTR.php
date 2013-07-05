<h2>TECNICO RECARGA</h2>

 
<?php foreach ($procesos as $i => $proceso) {
	
	$description = $proceso->atributos;
	$paquetes = $proceso->Paquetematenimiento;
	var_dump($description);
?>	
	<!-- <div class="ordenContent">
		<span><label>ORDEN</label><?php echo $description["fk_idEstado"]; ?></span>
		<span><label>ID PROCESO</label><?php echo $description["k_idProceso"]; ?></span>
		<span><label>DESCRIPCION</label><?php echo $description["n_descripcion"];?></span>		
	</div> -->
<?php } ?>