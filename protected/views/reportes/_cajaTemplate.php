<script type="text/x-handlebars-template" id="cajaTemplate">
	{{#if servicios}}
	<div class="servicios">
		<h4>REGISTROS VENTAS SERVICIOS</h4>		
		<table>
			<thead>
				<tr>
					<th>NOMBRE SERVICIO</th>
					<th>CANTIDAD</th>
					<th>COSTO UNIDAD</th>
					<th>INGRESO CAJA</th>
					<th>COSTO TECNICO</th>
					<th>MARGEN GANANCIA</th>
				</tr>
			</thead>
			<tbody>
				{{#each servicios}}
					<tr>
						<td>{{servicio.n_nomServicio}}</td>
						<td>{{cantidad}}</td>
						<td>{{servicio.v_costoServicio}}</td>
						<td>{{costoS}}</td>
						<td>{{costoT}}</td>
						<td>{{margenGananacia}}</td>
					</tr>
				{{/each}}
			</tbody>
		</table>
	</div>		
	{{/if}}

	{{#if totales}}
		<div class="totalesContent">			
			<span><label>Cobro Servicio Totalizado</label>{{totales.serTotal}}</span>
			<span><label>Costo Tecnico Totalizado</label>{{totales.tecTotal}}</span>
			<span><label>Ganancia Totalizado</label>{{totales.ganTotal}}</span>
		</div>
	{{/if}}


	{{#if ordenesRCaja}}
		<div class="serviciosOrden">
			<table>
				<thead>
					<tr>
						<th># Orden</th>
						<th>Fecha Ingreso</th>
						<th>Fecha Entrega</th>
						<th>Servicios</th>
						<th>Valor Orden</th>
						<th>Costo Tecnico</th>
						<th>Costo Partes</th>
						<th>Utilidad</th>
						<th>Fecha Pago Tecnico</th>
					</tr>	
				</thead>
				<tbody>
					{{#each ordenesRCaja}}
						<tr>
							<td>{{orden.k_idOrden}}</td>
							<td>{{orden.fchIngreso}}</td>
							<td>{{orden.fchEntrega}}</td>
							<td>
								<table>
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Cantidad</th>
										</tr>
									</thead>
									<tbody>
									{{#each servicios}}
										<tr>
											<td>{{servicio.n_nomServicio}}</td>
											<td>{{cantidad}}</td>
										</tr>									
									{{/each}}
									</tbody>
								</table>
							</td>
							<td>{{valores.valorOrden}}</td>
							<td>{{valores.costoTecnico}}</td>
							<td>{{valores.costoPartes}}</td>
							<td>{{valores.utilidad}}</td>
							<td>
								<table>
									<thead>
										<tr>
											<th>Tecnico</th>
											<th>Pago</th>
										</tr>
									</thead>
									<tbody>
										{{#each tecnicos}}
											<tr>										
												<td>{{nombre}}</td>
												<td>{{pago}}</td>
											</tr>
										{{/each}}										
									</tbody>
								</table>
							</td>
						</tr>
					{{/each}}
				</tbody>
			</table>
		</div>
	{{/if}}

	{{#if totalesOrdenR}}
		<div class="totalesContent" style="width:1250px !important; ">						
			<span style="width:23% !important; "><label>Valor Ordenes</label>{{totalesOrdenR.valorOrden}}</span>
			<span style="width:23% !important; "><label>Cobro Tecnicos</label>{{totalesOrdenR.costoTecnico}}</span>
			<span style="width:23% !important; "><label>Costo Partes</label>{{totalesOrdenR.costoPartes}}</span>
			<span style="width:23% !important; "><label>Utilidades</label>{{totalesOrdenR.utilidad}}</span>
		</div>	
	{{/if}}
</script>