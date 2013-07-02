<?php
/* @var $this ProcesoController */
/* @var $model Proceso */

$this->breadcrumbs=array(
	'Procesos'=>array('index'),
	$model->k_idProceso=>array('view','id'=>$model->k_idProceso),
	'Update',
);

$this->menu=array(
	array('label'=>'List Proceso', 'url'=>array('index')),
	array('label'=>'Create Proceso', 'url'=>array('create')),
	array('label'=>'View Proceso', 'url'=>array('view', 'id'=>$model->k_idProceso)),
	array('label'=>'Manage Proceso', 'url'=>array('admin')),
);
?>

<h1>Update Proceso <?php echo $model->k_idProceso; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>