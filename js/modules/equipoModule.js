$(document).ready(function() {
	var equipoModule = (function(){
		var marca = null, tipoEquipo=null;
		var init = function(config){
			console.log("init");
			marca = config.marca;
			tipoEquipo = config.tipoEquipo;
			getEspecificacion();
			bindEvents();
		},
		bindEvents = function(){			
			marca.change(getEspecificacion);
			tipoEquipo.change(getEspecificacion);
		},
		getEspecificacion = function(){
			if ($("#especificacionInput").autocomplete()){
				$("#especificacionInput").autocomplete('destroy');	
			};

			$.ajax({
				type:"POST",
				url:url,
				dataType:"json",
				data: {marca:marca.val(), tipoEquipo:tipoEquipo.val()},
				success:function(data){
					$("#especificacionInput").autocomplete({
					  source: data.list,
					  minLength:2
					});
				},
				error:function(error){
					console.log(error);
				}
			});
		};
		return {
			init: init
		}
	})();

	equipoModule.init({
		marca : $("#Marca_n_nombreMarca"),
		tipoEquipo : $("#Tipoequipo_n_tipoEquipo")
	});
});
