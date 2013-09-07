
<script type="text/javascript">
	var admin = true;
</script>

<div id="contentBtnTec">
	<a id="TMBtn" class="no-selected">MANTENIMIENTO</a>
	<a id="TRBtn" class="no-selected">RECARGAS</a>
</div>
<div id="AllTecs">
	<div id="divTM" style="display:none;">
		<?php
			echo $this->renderPartial('_viewTM', array('procesos'=>$procesos));
		?>
	</div>

	<div id="divTR" style="display:none;">
		<?php
			echo $this->renderPartial('_viewTR', array('procesos'=>$procesos));
		?>
	</div>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		console.log("ready");
		$("#TMBtn").click(function(){
			$("#divTR").css("display","none");
			$("#divTM").css("display","block");
			$("#TRBtn").addClass("no-selected");
			$(this).removeClass("no-selected");
		});
		$("#TRBtn").click(function(){
			$("#divTM").css("display","none");
			$("#divTR").css("display","block");
			$("#TMBtn").addClass("no-selected");
			$(this).removeClass("no-selected");
		});
	})
</script>

