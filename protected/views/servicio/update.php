<?php
/* @var $this ServicioController */
/* @var $model Servicio */

$this->breadcrumbs=array(
	'Servicios'=>array('index'),
	$model->k_idServicio=>array('view','id'=>$model->k_idServicio),
	'Update',
);

$this->menu=array(
	array('label'=>'List Servicio', 'url'=>array('index')),
	array('label'=>'Create Servicio', 'url'=>array('create')),
	array('label'=>'View Servicio', 'url'=>array('view', 'id'=>$model->k_idServicio)),
	array('label'=>'Manage Servicio', 'url'=>array('admin')),
);
?>

<h1>Update Servicio <?php echo $model->k_idServicio; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>