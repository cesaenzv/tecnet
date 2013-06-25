<?php
/* @var $this ProductoController */
/* @var $model Producto */

$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->k_idProducto,
);

?>

<h1>View Producto #<?php echo $model->k_idProducto; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_idProducto',
		'n_nombreProducto',
		'v_costoProducto',
	),
)); ?>
