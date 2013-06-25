<?php
/* @var $this MarcaController */
/* @var $model Marca */

$this->breadcrumbs=array(
	'Marcas'=>array('index'),
	'Create',
);

?>

<h1>Create Marca</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>