<script type="text/x-handlebars-template" id="historialTemplate">
	<div class="reporteContent">
		{{#if cliente}}
			<div class="cliente boxInfo">
				<h4>CLIENTE</h4>
				<span><label>Documento</label>{{cliente.k_identificacion}}</span>
				<span><label>Tipo Documento</label>{{cliente.i_nit}}</span>
				<span><label>Nombre</label>{{cliente.n_nombre}} {{cliente.n_apellido}}</span>
				<span><label>Direccion</label>{{cliente.o_direccion}}</span>
				<span><label>Celular</label>{{cliente.o_celular}}</span>
				<span><label>Telefono</label>{{cliente.o_fijo}}</span>
				<span><label>Correo Electronico</label>{{cliente.o_mail}}</span>
			</div>
		{{/if}}

		{{#if ordenes}}
			<div class="ordenes boxInfo">
				<h4>ORDENES</h4>
				{{#each ordenes}}					
					<div class="orden">
						<h5>ORDEN #{{orden.k_idOrden}}</h5>						
						<span><label>CAJERO</label>{{orden.k_idUsuario}}</span>
						<span><label>FECHA INGRESO</label>{{orden.fchIngreso}}</span>
						<span><label>FECHA ENTREGA</label>{{orden.fchEntrega}}</span>
						<div class="serviciosOrden">
							<h5>SERVICIOS DE LA ORDEN {{orden.k_idOrden}}</h5>
							<table>
								<thead>
									<tr>
								    	<th>CANTIDAD</th>
								      	<th>NOMBRE SERVICIO</th>
								      	<th>COSTO</th>			      	
								    </tr>
								</thead>
								<tbody>
									{{#each servicios}}
										<tr>
											<td>{{cantidad}}</td>
											<td>{{Servicio.n_nomServicio}}</td>
											<td>{{Servicio.v_costoServicio}}</td>
										</tr>
									{{/each}}
								</tbody>
							</table>
						</div>
					</div>
				{{/each}}	
			</div>
		{{/if}}

		{{#if equipos}}
			<div class="equipos boxInfo">
				<h4>EQUIPO(S)</h4>
				<table>
					<thead>
						<tr>
					    	<th>ID</th>
					      	<th>NOMBRE</th>
					      	<th>ESPECIFICACION</th>
					      	<th>TIPO EQUIPO</th>
					      	<th>MARCA</th>
					      	<th>INGRESADO</th>				      	
					    </tr>
					</thead>
					<tbody>
					{{#each equipos}}
						<tr>
							<td>{{k_idEquipo}}</td>
							<td>{{n_nombreEquipo}}</td>
							<td>{{k_idEspecificacion.n_nombreEspecificacion}}</td>
							<td>{{k_idEspecificacion.k_idTipoEquipo}}</td>
							<td>{{k_idEspecificacion.k_idMarca}}</td>
							<td>{{k_idEspecificacion.i_inhouse}}</td>
						</tr>
					{{/each}}
					</tbody>
				</table>
			</div>
		{{/if}}

		{{#if servicios}}
			<div class="servicios boxInfo">
				<h4>SERVICIOS</h4>
				<table>
					<thead>
						<tr>
					    	<th>CANTIDAD</th>
					      	<th>NOMBRE SERVICIO</th>
					      	<th>COSTO</th>			      	
					    </tr>
					</thead>
					<tbody>
						{{#each servicios}}
							<tr>
								<td>{{cantidad}}</td>
								<td>{{Servicio.n_nomServicio}}</td>
								<td>{{Servicio.v_costoServicio}}</td>
							</tr>
						{{/each}}
					</tbody>
				</table>
			</div>
		{{/if}}
	</div>	
</script>