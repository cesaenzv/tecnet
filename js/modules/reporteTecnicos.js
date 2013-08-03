$(document).ready(function(){
	var reporteTecnico = (function(){
		var userNameTec, tipoTec, plantillaTec,consultBtn,fchI,fchF,fechasContent;
		/*_________________Funciones_________________*/
		var init = function(config){
			fechasContent = config.fechasContent;
			fchI = config.fchI;
			fchF = config.fchF;
			consultBtn = config.consultBtn;
			tecData = $("#tecnicoContent");
			plantillaTec = $("#tecnicosTemplate");
			jQueryPlugins();
			bindEvents();
		},
		jQueryPlugins = function(){
			fechasContent.css('display','none');
			fchI.datepicker({ dateFormat: "yy-mm-dd" });
			fchF.datepicker({ dateFormat: "yy-mm-dd" });
		},
		bindEvents = function(){
			$("#configContent").find("input[name=tecType]:radio").each(function(i,item){
				$(item).click(function(){
					getTecs($(item));	
				});
			});
			$("#configContent").find("input[name=reportType]:radio").each(function(i,item){
				$(item).click(function(){
					if($(item).val() != "fct"){
						fechasContent.css('display','none');
					}else{
						fechasContent.css('display','inline-block');
					}
				});
			});
			consultBtn.on('click',function(){
				consultarReporte();
			});
		},
		consultarReporte = function(){
			var typeConsult = $('input[name=reportType]:checked').val();
			var tec = $('#tecSelected').val();
			var typeTec = $('input[name=tecType]:checked').val();
			if(typeConsult!== undefined && tec !== undefined ){
				$.ajax({
				type:'POST',
				url:url,
				dataType: "json",
				data: {
					fchI: fchI.val(),
					fchF: fchF.val(),
					tecId:tec,
					typeConsult:typeConsult,
					typeTec:typeTec,
				},
				success:function(data){
					console.log(data);
					showTecData(data);
				},
				error:function(){
				}
			});
			}
			
		},
		getTecs = function (item) {
			$.ajax({
				type:'POST',
				url:urlGetTecs,
				dataType: "json",
				data: {
					typeTec:item.val()
				},
				success:function(data){					
					showListTecs(data);
				},
				error:function(){
				}
			});
		},
		showListTecs = function(tecs){			
			var s = $('<select id=tecSelected/>');
			for (var x=0;x<tecs.length;x++){
			    $('<option />', {value: tecs[x].id, text: tecs[x].username}).appendTo(s);
			}
			$("#listTecnicos").html(s);
			$("#listTecnicos").prepend("<label>Tecnicos</label>");
		},
		showTecData = function(data){
			var template = Handlebars.compile(plantillaTec.html());
            var contenido = template(data);           
            tecData.html(contenido);
		};

		return {
			init:init
		}	
	})();

	reporteTecnico.init({
		fechasContent : $("#fechas"),
		consultBtn : $("#consultBtn"),
		fchI: $("#fchI"),
		fchF: $("#fchF")
	});
});
