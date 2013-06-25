<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
	'Equipos'=>array('index'),
	'Create',
);

?>

<h1>Create Equipo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>