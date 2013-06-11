<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	$model->k_idOrden=>array('view','id'=>$model->k_idOrden),
	'Update',
);

$this->menu=array(
	array('label'=>'List Orden', 'url'=>array('index')),
	array('label'=>'Create Orden', 'url'=>array('create')),
	array('label'=>'View Orden', 'url'=>array('view', 'id'=>$model->k_idOrden)),
	array('label'=>'Manage Orden', 'url'=>array('admin')),
);
?>

<h1>Update Orden <?php echo $model->k_idOrden; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>