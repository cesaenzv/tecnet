<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	$model->k_idOrden,
);

$this->menu=array(
	array('label'=>'List Orden', 'url'=>array('index')),
	array('label'=>'Create Orden', 'url'=>array('create')),
	array('label'=>'Update Orden', 'url'=>array('update', 'id'=>$model->k_idOrden)),
	array('label'=>'Delete Orden', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->k_idOrden),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Orden', 'url'=>array('admin')),
);
?>

<h1>View Orden #<?php echo $model->k_idOrden; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_idOrden',
		'k_idUsuario',
	),
)); ?>
