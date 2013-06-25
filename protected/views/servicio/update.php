<?php
/* @var $this ServicioController */
/* @var $model Servicio */

$this->breadcrumbs=array(
	'Servicios'=>array('index'),
	$model->k_idServicio=>array('view','id'=>$model->k_idServicio),
	'Update',
);

?>

<h1>Update Servicio <?php echo $model->k_idServicio; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>