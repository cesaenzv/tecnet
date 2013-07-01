var equipoModule = (function(){
	var marca = null, tipoEquipo=null, url;
	var setMarca =function(val){
		marca = val.value;
		getReferences();
	},setTipoEquipo = function(val){
		tipoEquipo = val.value;
		getReferences();
	},setUrl = function(val){
		url = val;
	},getReferences = function(){
		if (marca !== null && tipoEquipo !==null){
			if ($("#especificacionInput").autocomplete()){
				$("#especificacionInput").autocomplete('destroy');	
			};			
			$.ajax({
				url:url,
				data: {marca:marca, tipoEquipo:tipoEquipo},
				success:function(data){
					data =JSON.parse(data);
					$("#especificacionInput").autocomplete({
					  source: data.list,
					  minLength:2
					});
				},
				error:function(){
					console.log("error");
				}
			});
		}
	};
	return {
		setTipoEquipo:setTipoEquipo,
		setMarca:setMarca,
		setUrl:setUrl
	}
})();

