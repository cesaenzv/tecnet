<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->k_identificacion,
);

$this->menu=array(
	array('label'=>'List Cliente', 'url'=>array('index')),
	array('label'=>'Create Cliente', 'url'=>array('create')),
	array('label'=>'Update Cliente', 'url'=>array('update', 'id'=>$model->k_identificacion)),
	array('label'=>'Delete Cliente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->k_identificacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cliente', 'url'=>array('admin')),
);
?>

<h1>View Cliente #<?php echo $model->k_identificacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_identificacion',
		'n_nombre',
		'n_apellido',
		'o_direccion',
		'o_celular',
		'o_fijo',
		'o_mail',
		'k_usuarioCrea',
	),
)); ?>
