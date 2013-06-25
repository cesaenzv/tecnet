<?php
/* @var $this EspecificacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Especificacions',
);

?>

<h1>Especificacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
