$(document).ready(function(){
	var reporteCaja = (function(){
		var fchI, fchF, cajaData, consultBtn, plantillaCaja, listTipoSer;
		/*_________________Funciones_________________*/
		var init = function(config){
			fchI = config.fchI;
			fchF = config.fchF;
			listTipoSer = $("#listTipoSer");
			listServicios = $("#listServicios");
			cajaData = $("#TemplateContent");
			plantillaCaja = $("#cajaTemplate");
			consultBtn = config.consultBtn;
			jQueryPlugins();
			bindEvents();
		},
		jQueryPlugins = function(){
			listTipoSer.css("display","none");
			listServicios.css("display","none");
			fchI.datepicker({ dateFormat: "yy-mm-dd" });
			fchF.datepicker({ dateFormat: "yy-mm-dd" });
		},
		bindEvents = function(){
			$("#configContent").find("input[name=cajaType]:radio").each(function(i,item){
				$(item).click(function(){
					if($(item).val() == 'ingS'){
						getServicios($(item));
						listTipoSer.css("display","none");						
					}else if($(item).val() == 'ingTS'){
						listTipoSer.css("display","inline-block");
						listServicios.css("display","none");
					}else if($(item).val() == 'ingO'){
						listServicios.css("display","none");
						listTipoSer.css("display","none");
					}						
				});
			});
			consultBtn.on('click',function(){
				consultarReporte();
			});
		},
		getServicios = function (item) {
			$.ajax({
				type:'POST',
				url:urlGetServicios,
				dataType: "json",
				success:function(data){					
					showListServicios(data);
				},
				error:function(){
				}
			});
		},
		showListServicios = function(serv){			
			var s = $('<select id=servSelected/>');
			for (var x=0;x<serv.length;x++){
			    $('<option />', {value: serv[x].k_idServicio, text: serv[x].n_nomServicio}).appendTo(s);
			}
			listServicios.html(s);
			listServicios.prepend("<label>Servicios</label>");
			listServicios.css("display","inline-block");
		},
		consultarReporte = function(){
			var typeConsult = $('input[name=cajaType]:checked').val();
			var servicio = null;
			if($("#servSelected")!== undefined){
				servicio = $("#servSelected").val();
			}
			if(typeConsult !== undefined){
				$.ajax({
					type:'POST',
					url:url,
					dataType: "json",
					data: {
						servicioID:servicio,
						typeConsult:typeConsult, 
						fchF:fchF.val(),
						fchI:fchI.val(),
						tipoServicio:$("#tipoServicio").val()
					},
					success:function(data){
						console.log(data);
						if(typeConsult == 'ingS' || typeConsult == 'ingTS'){
							console.log(data.servicios.length);
							if(data.servicios.length != 0){
								showCajaData(data);	
							}else{
								cajaData.html("<h1>Sin resultados</h1>");
							}							
						}else{
							if(data.ordenesRCaja.length != 0){
								getTotalesOrdeneReport(data);	
							}else{
								cajaData.html("<h1>Sin resultados</h1>");
							}								
						}				
						
					},
					error:function(){
						cajaData.html('');
						alert("La busqueda no fue exitosa, verifique los datos por favor");
					}
				});
			}			
		},
		showCajaData = function(data){			
			var template = Handlebars.compile(plantillaCaja.html());
            var contenido = template(data);           
            cajaData.html(contenido);
        },
        getTotalesOrdeneReport =  function(data){
        	var totales = {valorOrden:0, costoTecnico : 0, costoPartes : 0, utilidad: 0 };
    		for (var i = 0; i < data.ordenesRCaja.length; i++) {
    			totales.costoPartes += data.ordenesRCaja[i].valores.costoPartes;	
    			totales.costoTecnico += data.ordenesRCaja[i].valores.costoTecnico;
    			totales.utilidad += data.ordenesRCaja[i].valores.utilidad;
    			totales.valorOrden += data.ordenesRCaja[i].valores.valorOrden;
    		}
    		data.totalesOrdenR = totales;
        	showCajaData(data);
        };

		return {
			init:init
		}	
	})();

	reporteCaja.init({
		fchI: $("#fchI"),
		fchF: $("#fchF"),
		consultBtn : $("#consultBtn")
	});
});
