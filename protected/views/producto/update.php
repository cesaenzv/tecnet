<?php
/* @var $this ProductoController */
/* @var $model Producto */

$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->k_idProducto=>array('view','id'=>$model->k_idProducto),
	'Update',
);

?>

<h1>Update Producto <?php echo $model->k_idProducto; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>