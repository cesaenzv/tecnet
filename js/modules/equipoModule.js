$(document).ready(function() {
	var equipoModule = (function(){
		var marca = null, tipoEquipo=null;
		var init = function(config){
			console.log("init");
			marca = config.marca;
			tipoEquipo = config.tipoEquipo;
			getEspecificacion();
			JQueryPlugin();
			bindEvents();			
		},
		bindEvents = function(){	
			marca.change(getEspecificacion);
			tipoEquipo.change(getEspecificacion);
			$("#btnTipoEquipo").click(function(){
				getViewDialog($("#addTipoEquipo"),"../tipoequipo/createFancy/");
			});
			$("#btnMarca").click(function(){
				getViewDialog($("#addMarca"),"../marca/createFancy/");
			});
			$("#btnEspecificacion").click(function(){
				getViewDialog($("#addEspecificacion"),"../especificacion/createFancy/");
			});
			getEspecificacion();
		},
		JQueryPlugin = function(){
			$("#addTipoEquipo").dialog({autoOpen:false, close : function(){ window.location.reload()}});
			$("#addMarca").dialog({autoOpen:false, close : function(){ window.location.reload()}});
			$("#addEspecificacion").dialog({autoOpen:false, close : function(){ window.location.reload()}});
		},
		getEspecificacion = function(){
			$.ajax({
				type:"POST",
				url:urlGetModelList,
				dataType:"json",
				data: {marca:marca.val(), tipoEquipo:tipoEquipo.val()},
				success:function(data){

					var s = $('<select id=n_nombreEspecificacion name=n_nombreEspecificacion/>');
					$.each(data.list, function(index,val){
						$('<option />', {value: index, text: val}).appendTo(s);
					});

					$("#especificacionRow").html(s);
				},
				error:function(error){
					console.log(error);
				}
			});
		},
		getViewDialog = function(obj, url){
			obj.dialog( "option", "title", "Crear Cliente" );
            obj.dialog( "option", "width", 450 );
            obj.dialog( "option", "minHeight", 400 );            
            obj.dialog( "option", "resizable", false );
            obj.dialog("open");
            obj.find("#iframe").attr('src',url);
            obj.find("#iframe").attr('width',"410");
            obj.find("#iframe").attr('min-height',"400");      
            obj.dialog( "option", "position", "center");

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
