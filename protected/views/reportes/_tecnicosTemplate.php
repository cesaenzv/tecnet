<script type="text/x-handlebars-template" id="tecnicosTemplate">
	<div id="reporteContent">
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
														<th>duracion</th>
													</tr>
												</thead>
												<tbody>
													{{#each procesos}}
														<tr>
															<td>{{proceso.fchAsignacion}}</td>
															<td>{{proceso.fchFinalizacion}}</td>
															<td>{{proceso.n_descripcion}}</td>
															<td>{{duracion}} </td>
														</tr>
													{{/each}}
												</tbody>
											</table>
										</div>
									{{/each}}								
								{{else}}
									<div class="orden">
									</div>
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
														<th>duracion</th>
													</tr>
												</thead>
												<tbody>
													{{#each procesos}}
														<tr>
															<td>{{proceso.fchAsignacion}}</td>
															<td>{{proceso.fchFinalizacion}}</td>
															<td>{{proceso.n_descripcion}}</td>
															<td>{{duracion}} </td>
														</tr>
													{{/each}}
												</tbody>
											</table>
										</div>
									{{/each}}								
								{{else}}
									<div class="orden">
									</div>	
								{{/if}}
							</div>
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
						{{#if pagable}}
							<th>Cancelar</th>
						{{/if}}
					</tr>
				</thead>
				<tbody>
					{{#each facturas}}
						<tr>
							<td>{{fechaFin}}</td>
							<td>{{n_nomServicio}}</td>
							<td>{{v_costoServicioTecnico}}</td>
							{{#if pagable}}
								<td>								
									{{#if estadoPago}}
										<strong style="color:red;">Pagado</strong>
									{{else}}
										<input type="button" class="pagoServicio" data-ids={{k_idServicio}} data-idp={{k_idProceso}} value="Pagar"/>
									{{/if}}								
								</td>
								<td>
									{{fchPagoTecnico}}
								</td>
							{{/if}}
						</tr>
					{{/each}}
				</tbody>			
			</table>
			<h4 style="background-color:#666e73; color:white;">Pago Total ${{total}}</h4>
		{{/if}}
	</div>
</script>