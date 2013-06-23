<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	'Create',
);

?>

<h1>Create Orden</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>