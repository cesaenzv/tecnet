<?php
/* @var $this TipoequipoController */
/* @var $model Tipoequipo */

$this->breadcrumbs=array(
	'Tipoequipos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Tipoequipo', 'url'=>array('index')),
	array('label'=>'Create Tipoequipo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tipoequipo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manejar Tipos de Equipos</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tipoequipo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'k_idTipo',
		'n_tipoEquipo',
		array(
			'class'=>'CButtonColumn',
            'template' => '{update}',
		),
	),
)); ?>
