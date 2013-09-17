<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cliente-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manejar Clientes</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cliente-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'k_identificacion',
		'n_nombre',
		'n_apellido',
		'o_direccion',
		'o_celular',
		'o_fijo',
		/*
		'o_mail',
		'k_usuarioCrea',
		*/		
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
        ),
	),
)); ?>
