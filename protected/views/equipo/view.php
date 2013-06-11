<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
	'Equipos'=>array('index'),
	$model->k_idEquipo,
);

$this->menu=array(
	array('label'=>'List Equipo', 'url'=>array('index')),
	array('label'=>'Create Equipo', 'url'=>array('create')),
	array('label'=>'Update Equipo', 'url'=>array('update', 'id'=>$model->k_idEquipo)),
	array('label'=>'Delete Equipo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->k_idEquipo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Equipo', 'url'=>array('admin')),
);
?>

<h1>View Equipo #<?php echo $model->k_idEquipo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_idEquipo',
		'n_nombreEquipo',
		'k_idCliente',
		'k_idEspecificacion',
	),
)); ?>
