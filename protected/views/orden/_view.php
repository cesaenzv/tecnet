<?php
/* @var $this OrdenController */
/* @var $data Orden */
?>

<script type="text/javascript">
	
    
    var	getGridProcesos = '<?php echo Yii::app()->createAbsoluteUrl("Orden/GetEquiposOrden"); ?>';
    

</script>

<div class="view">

	<div class="row">
		<h2>Información Orden</h2>
		<div class="row">
			<span style="margin:1%; display:inline-block; width:29%;"> <b>Fecha Ingreso: </b> <?php echo $model->fchIngreso?></span>	
			<span style="margin:1%; display:inline-block; width:29%;"> <b>Fecha Finalizacion: </b> <?php echo $model->fchEntrega?></span>
			<span style="margin:1%; display:inline-block; width:29%;"> <b>Estado Orden: </b> <?php echo $estado?></span>
			<span style="margin:1%; display:inline-block; width:100%;"> <b>Observaciones: </b> <?php echo $model->n_Observaciones?></span>
			</br>
			<?php 
				if(isset($paquetes)):
			?>				
				<table>
					<thead>
						<tr>
							<th>Equipo</th>
							<th>Especificacion</th>
							<th>Garantia</th>
							<th>Descuento</th>
							<th>Estado</th>
						</tr>
					</thead>
			<?php 
					foreach ($paquetes as $i => $paquete):						
			?>				
					<tbody>
						<tr>
							<td><?php echo $paquete['equipo']['n_nombreEquipo']?></td>
							<td><?php echo $paquete['equipo']['k_idEspecificacion']?></td>
							<td><?php echo $paquete['garantia']?></td>
							<td><?php echo $paquete['descuento']?></td>
							<td><?php echo $paquete['estado']?></td>
						</tr>
					</tbody>
			<?php
					endforeach; 
			?>
				</table>
			<?php
				endif;
			?>
		</div>
		<h2>Procesos de la Orden</h2>
		<div class="row">
			<table id="jqGridTable"></table>    
    		<div id="jqGridPager"></div>
		</div>

	</div>


</div>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/modules/ordenViewModule.js'); ?>