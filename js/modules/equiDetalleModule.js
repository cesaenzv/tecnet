var equiDetalleModule = (function(){
	var fchI, fchF, btnGetDetalle,idEquipo, dataDetalle;
	var init = function(config){
		idEquipo = config.idEquipo;
		dataDetalle = $("#TemplateContentDetalle");
		plantillaDetalle = $("#detalleMaqTemplate");
		fchI = config.fchI;
		fchF = config.fchF;
		btnGetDetalle = config.btnGetDetalle;
		jQueryPlugins();
		bindEvents();
	},
	bindEvents = function (){
		btnGetDetalle.click(function(e){
			e.preventDefault();
			getDetalleMaquina();
		})
	},
	getDetalleMaquina = function(){
		$.ajax({
			type:"POST",
			url:urlGetmaqDetalle,
			dataType:"json",
			data: {idEquipo:idEquipo.text(), fchI:fchI.val(), fchF:fchF.val(), servicio:$("#idServicio").val()},
			success:function(data){
				if(data.timeline.length >= 1){
					showDetalleData(data);
				}else{
					dataDetalle.html("<h4>No hay procesos asociados al equipo</h4>");	
				}
			},
			error:function(error){
				console.log(error);
			}
		});

	},
	jQueryPlugins = function(){
		fchI.datepicker({ dateFormat: "yy-mm-dd" });
		fchF.datepicker({ dateFormat: "yy-mm-dd" });
	},
	showDetalleData = function(data){
		var template = Handlebars.compile(plantillaDetalle.html());
        var contenido = template(data);           
        dataDetalle.html(contenido);
    };

	return {
		init:init
	};

})();

equiDetalleModule.init({
	fchI:$("#fchID"),
	fchF:$("#fchFD"),
	btnGetDetalle:$("#btnGetDetalle"),
	idEquipo : $("#idEquipoLbl")
});

