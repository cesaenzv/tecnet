<?php
/* @var $this MarcaController */
/* @var $model Marca */

$this->breadcrumbs=array(
	'Marcas'=>array('index'),
	$model->k_idMarca=>array('view','id'=>$model->k_idMarca),
	'Update',
);

$this->menu=array(
	array('label'=>'List Marca', 'url'=>array('index')),
	array('label'=>'Create Marca', 'url'=>array('create')),
	array('label'=>'View Marca', 'url'=>array('view', 'id'=>$model->k_idMarca)),
	array('label'=>'Manage Marca', 'url'=>array('admin')),
);
?>

<h1>Update Marca <?php echo $model->k_idMarca; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>