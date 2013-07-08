<script type="text/x-handlebars-template" id="procesServicesTemplate">
	<select multiple="multiple" id="multiSProd" name="">
		{{#each productos}}
	    	<option value={{k_idProducto}}>{{n_nombreProducto}}</option>	    	
	    {{/each}}
    </select>
</script>