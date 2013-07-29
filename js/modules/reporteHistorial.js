$(document).ready(function(){
	var reporteHistorial = (function(){
		var doc, tipoHistorial,tipoDoc,/*initDate,endDate,*/consultBtn;
		/*_________________Funciones_________________*/
		var init = function(config){
			doc = config.doc;
			tipoDoc = config.tipoDoc;
			// initDate = config.initDate;
			// endDate = config.endDate;
			consultBtn = config.consultBtn;
			bindEvents();
		},
		bindEvents = function(){
			$("#config").find("input[type=radio]").each(function(i,item){
				$(item).click(function(){
					showTypeDoc($(item));	
				});
			});
			consultBtn.on('click',function(){
				consultarHistorial();
			});
		},
		showTypeDoc = function (item) {
			if(item.val() === "clt"){
				$("#contentTipDoc").css('display','inline-block');
			}else{
				$("#contentTipDoc").css('display','none');
			}
		},
		checkTypeConsult = function(){

		},
		consultarHistorial = function(){
			var typeConsult = $('input[name=tipoHistorial]:checked').val();
			if(typeConsult !== undefined){
				$.ajax({
					url:url,
					data: {
						typeConsult:typeConsult, 
						// initDate:initDate.val(), 
						// endDate:endDate.val(), 
						doc: doc, 
						tipoDoc : tipoDoc.val()
					},
					success:function(data){
						data =JSON.parse(data);
					},
					error:function(){
						console.log("error");
					}
				});
			}			
		};

		return {
			init:init
		}	
	})();

	reporteHistorial.init({
		doc : $("#idConsult"),
		tipoDoc :$("#tipoDoc"),
		// initDate :$("#initDate"),
		// endDate :$("#endDate"),
		consultBtn : $("#consultBtn")
	});
});
