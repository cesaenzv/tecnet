<?php
/* @var $this EspecificacionController */
/* @var $model Especificacion */

$this->breadcrumbs=array(
	'Especificacions'=>array('index'),
	$model->k_especificacion,
);

$this->menu=array(
	array('label'=>'List Especificacion', 'url'=>array('index')),
	array('label'=>'Create Especificacion', 'url'=>array('create')),
	array('label'=>'Update Especificacion', 'url'=>array('update', 'id'=>$model->k_especificacion)),
	array('label'=>'Delete Especificacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->k_especificacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Especificacion', 'url'=>array('admin')),
);
?>

<h1>View Especificacion #<?php echo $model->k_especificacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_especificacion',
		'n_nombreEspecificacion',
		'k_idTipoEquipo',
		'k_idMarca',
	),
)); ?>
