<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
	'Equipos'=>array('index'),
	$model->k_idEquipo=>array('view','id'=>$model->k_idEquipo),
	'Update',
);

?>

<h1>Update Equipo <?php echo $model->k_idEquipo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>