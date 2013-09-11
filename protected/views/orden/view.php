<h1>Visualizacion Orden #<span id="k_idOrden" ><?php echo $model->k_idOrden; ?></span></h1>


<?php echo $this->renderPartial('_view', array(	'model' => $model, 
												'estado' =>$estado, 
												'paquetes' => $paquetes)); ?>
