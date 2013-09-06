<?php
/* @var $this TipoequipoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipoequipos',
);
?>

<h1>Tipoequipos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
