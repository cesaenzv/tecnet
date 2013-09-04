<script type="text/x-handlebars-template" id="detalleMaqTemplate">
	<div class="detalleMaq">
		{{#if timeline}}
			<table>
				<thead>
					<tr>
						<th>SERVICIO</th>
						<th>TECNICO</th>
						<th>DESCRIPCION</th>
						<th>ESTADO</th>
						<th>FECHA INICIO</th>
						<th>FECHA FIN</th>
					</tr>
				</thead>
				<tbody>
					{{#each timeline}}
						<tr>
							<td>{{servicio}}</td>
							<td>{{tecnico}}</td>
							<td>{{descripcion}}</td>
							<td>{{estado}}</td>
							<td>{{fchI}}</td>
							<td>{{fchF}}</td>
						</tr>
					{{/each}}
				</tbody>
			</table>
		{{/if}}
	</div>
</script>