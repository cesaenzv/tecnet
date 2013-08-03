<script type="text/x-handlebars-template" id="tecnicosTemplate">
	<div class="reporteContent">
		{{#if equipos}}
			<div class="equipos">
				{{#each equipos}}
					<div class="equipoOrd">
						<h4>EQUIPO {{equipo.n_nombreEquipo}}</h4>
						<span><label>Tipo Equipo:</label>{{equipo.k_idEspecificacion.k_idTipoEquipo}}</span>
						<span><label>Marca: </label>{{equipo.k_idEspecificacion.k_idMarca}}</span>
						<span><label>Especificacion: </label>{{equipo.k_idEspecificacion.n_nombreEspecificacion}}</span>
						<div class="ordenes">
							<div class="ordColumn">
								<h5>ORDENES PROCESADAS</h5>
								{{#if terminados}}									
									{{#each terminados}}
										<div class="orden">
											<h6 style="background-color:rgba(0,210,0,0.5)">Orden {{orden.k_idOrden}}</h6>
											<p>
												<i><b>Fecha ingreso: </b>{{orden.fchIngreso}}</i>
												<i><b>Fecha entrega: </b>{{orden.fchEntrega}}</i>
											</p>
											<table>
												<thead>
													<tr>
														<th>Fecha Asignacion</th>
														<th>Fecha Finalizacion</th>
														<th>Descripcion</th>
													</tr>
												</thead>
												<tbody>
													{{#each procesos}}
														<tr>
															<td>{{fchAsignacion}}</td>
															<td>{{fchFinalizacion}}</td>
															<td>{{n_descripcion}}</td>
														</tr>
													{{/each}}
												</tbody>
											</table>
										</div>
									{{/each}}
								{{/if}}
							</div>
							<div class="ordColumn">
								<h5>ORDENES EN PROCESO</h5>
								{{#if procesando}}									
									{{#each procesando}}
										<div class="orden">
											<h6 style="background-color:rgba(204,204,0,0.5)">Orden {{orden.k_idOrden}}</h6>
											<p>
												<i><b>Fecha ingreso: </b>{{orden.fchIngreso}}</i>
												<i><b>Fecha entrega: </b>{{orden.fchEntrega}}</i>
											</p>
											<table>
												<thead>
													<tr>
														<th>Fecha Asignacion</th>
														<th>Fecha Finalizacion</th>
														<th>Descripcion</th>
													</tr>
												</thead>
												<tbody>
													{{#each procesos}}
														<tr>
															<td>{{fchAsignacion}}</td>
															<td>{{fchFinalizacion}}</td>
															<td>{{n_descripcion}}</td>
														</tr>
													{{/each}}
												</tbody>
											</table>
										</div>
									{{/each}}
								{{/if}}
							</div>
					</div>
				{{/each}}
			</div>
		{{/if}}

		{{#if facturas}}
			<table>
				<thead>
					<tr>
						<th>Fecha</th>
						<th>Servicio</th>
						<th>Pago Tecnico</th>
					</tr>
				</thead>
				<tbody>
					{{#each facturas}}
						<tr>
							<td>{{fechaFin}}</td>
							<td>{{n_nomServicio}}</td>
							<td>{{v_costoServicioTecnico}}</td>
						</tr>
					{{/each}}
				</tbody>			
			</table>
			<h4 style="background-color:#666e73; color:white;">Pago Total ${{total}}</h4>
		{{/if}}
	</div>
</script>