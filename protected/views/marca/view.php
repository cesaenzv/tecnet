<?php
/* @var $this MarcaController */
/* @var $model Marca */

$this->breadcrumbs=array(
	'Marcas'=>array('index'),
	$model->k_idMarca,
);

?>

<h1>View Marca #<?php echo $model->k_idMarca; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_idMarca',
		'n_nombreMarca',
	),
)); ?>
