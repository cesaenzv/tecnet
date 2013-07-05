<?php
/* @var $this DuracionController */
/* @var $model Duracion */

$this->breadcrumbs=array(
	'Duracions'=>array('index'),
	$model->k_idDuracion,
);

$this->menu=array(
	array('label'=>'List Duracion', 'url'=>array('index')),
	array('label'=>'Create Duracion', 'url'=>array('create')),
	array('label'=>'Update Duracion', 'url'=>array('update', 'id'=>$model->k_idDuracion)),
	array('label'=>'Delete Duracion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->k_idDuracion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Duracion', 'url'=>array('admin')),
);
?>

<h1>View Duracion #<?php echo $model->k_idDuracion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_idDuracion',
		'f_inicio',
		'f_fin',
		'fk_idProceso',
	),
)); ?>
