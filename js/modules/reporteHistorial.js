$(document).ready(function(){
	var reporteHistorial = (function(){
		var doc, tipoHistorial,tipoDoc,consultBtn,plantillaHistorial, fchIni, fchFin;
		/*_________________Funciones_________________*/
		var init = function(config){
			doc = config.doc;
			tipoDoc = config.tipoDoc;
			historialData = $("#TemplateContent");
			plantillaHistorial = $("#historialTemplate");
			consultBtn = config.consultBtn;
			fchFin = config.fchFin;
			fchIni = config.fchIni;	
			jQueryPlugins();		
			bindEvents();
			
		},
		bindEvents = function(){
			$("#configContent").find("input[type=radio]").each(function(i,item){
				$(item).click(function(){
					showTypeDoc($(item));	
				});
			});
			consultBtn.on('click',function(){
				consultarHistorial();
			});
		},
		jQueryPlugins = function(){
			$("#contentFecha").css('display','none');
			fchIni.datepicker({ dateFormat: "yy-mm-dd" });
			fchFin.datepicker({ dateFormat: "yy-mm-dd" });
		},
		showTypeDoc = function (item) {
			if(item.val() === "clt"){
				$("#contentTipDoc").css('display','inline-block');
				$("#contentFecha").css('display','inline-block');
			}else{
				$("#contentTipDoc").css('display','none');
				$("#contentFecha").css('display','none');
			}
		},
		consultarHistorial = function(){
			var typeConsult = $('input[name=tipoHistorial]:checked').val();
			if(typeConsult !== undefined){
				$.ajax({
					type:'POST',
					url:url,
					dataType: "json",
					data: {
						typeConsult:typeConsult, 
						doc: doc.val(), 
						tipoDoc : tipoDoc.val(),
						fchIni : fchIni.val(),
						fchFin : fchFin.val(),
					},
					success:function(data){
						showHistorialData(data);
						activeFancys();
					},
					error:function(){
						historialData.html('');
						alert("La busqueda no fue exitosa, verifique los datos por favor");
					}
				});
			}			
		},
		activeFancys = function(){
			$("div.equipos.boxInfo").find("tr.trData").each(function(i,item){
				var idE = $(item).find("span.idE").text();
				var fancy = $(item).find("a.linkFancy");
				fancy.attr('href',urlFancyEquipoDetalle+"/"+idE);
				fancy.fancybox({width:500});
			});
		},
		showHistorialData = function(data){
			var template = Handlebars.compile(plantillaHistorial.html());
            var contenido = template(data);           
            historialData.html(contenido);
        };

		return {
			init:init
		}	
	})();

	reporteHistorial.init({
		doc : $("#idConsult"),
		tipoDoc :$("#tipoDoc"),
		consultBtn : $("#consultBtn"),
		fchIni : $("#initDate"),
		fchFin : $("#endDate")
	});
});
