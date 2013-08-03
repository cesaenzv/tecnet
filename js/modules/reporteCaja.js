$(document).ready(function(){
	var reporteCaja = (function(){
		var fchI, fchF, cajaData, consultBtn, plantillaCaja;
		/*_________________Funciones_________________*/
		var init = function(config){
			console.log("INicio");
			fchI = config.fchI;
			fchF = config.fchF;
			listServicios = $("#listServicios");
			cajaData = $("#TemplateContent");
			plantillaCaja = $("#cajaTemplate");
			consultBtn = config.consultBtn;
			jQueryPlugins();
			bindEvents();
		},
		jQueryPlugins = function(){
			listServicios.css("display","none");
			fchI.datepicker({ dateFormat: "yy-mm-dd" });
			fchF.datepicker({ dateFormat: "yy-mm-dd" });
		},
		bindEvents = function(){
			$("#configContent").find("input[name=cajaType]:radio").each(function(i,item){
				$(item).click(function(){
					if($(item).val() == 'ingS'){
						getServicios($(item));
					}else{
						listServicios.css("display","none");
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
						fchI:fchI.val()
					},
					success:function(data){
						showCajaData(data);
						console.log(data);
					},
					error:function(){
						historialData.html('');
						alert("La busqueda no fue exitosa, verifique los datos por favor");
					}
				});
			}			
		},
		showCajaData = function(data){
			var template = Handlebars.compile(plantillaCaja.html());
            var contenido = template(data);           
            cajaData.html(contenido);
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
