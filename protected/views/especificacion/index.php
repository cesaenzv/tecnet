<?php
/* @var $this EspecificacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Especificacions',
);

$this->menu=array(
	array('label'=>'Create Especificacion', 'url'=>array('create')),
	array('label'=>'Manage Especificacion', 'url'=>array('admin')),
);
?>

<h1>Especificacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
