<script type="text/x-handlebars-template" id="cajaTemplate">
	{{#if servicios}}
		<h3>REGISTROS VENTAS SERVICIOS<h4>		
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
	{{/if}}
	{{#if ordenesCaja}}
		<div class="ordenes boxInfo">
			<h4>ORDENES</h4>
			{{#each ordenesCaja}}					
				<div class="orden">
					<h5>ORDEN #{{orden.k_idOrden}}</h5>						
					<span><label>FECHA INGRESO</label>{{orden.fchIngreso}}</span>
					<span><label>FECHA ENTREGA</label>{{orden.fchEntrega}}</span>
					<div class="serviciosOrden">
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
				</div>
			{{/each}}	
		</div>
	{{/if}}
</script>