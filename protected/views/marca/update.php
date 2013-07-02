<?php
/* @var $this MarcaController */
/* @var $model Marca */

$this->breadcrumbs=array(
	'Marcas'=>array('index'),
	$model->k_idMarca=>array('view','id'=>$model->k_idMarca),
	'Update',
);

?>

<h1>Update Marca <?php echo $model->k_idMarca; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>