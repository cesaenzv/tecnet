<?php
/* @var $this ServicioController */
/* @var $model Servicio */

$this->breadcrumbs=array(
	'Servicios'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#servicio-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Servicios</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'servicio-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'k_idServicio',
		'n_nomServicio',
		'v_costoServicio',
		'v_costoServicioTecnico',
		'n_tipoServicio',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete} {asign}',
            'buttons' => array
                (
                'asign' => array
                    (
                    'label' => 'asignar/desasignar',
                    'imageUrl' => Yii::app()->getBaseUrl(true) . "/images/calificar.png",
                    'url' => '"#servicio_".$data->k_idServicio',
                    'htmlOptions' => 'width:16px, heigth:16px',
                    //'click'=>'js:function(){fancy("'.Yii::app()->createUrl("producto/AsignaServicio").'/'..'");return false;}',
                    'options' => array(
                        'class' => 'assing',
                    ),
                ),
            ),
        ),
    ),
));

?>
<?php 
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a.assing',
    'config'=>array(),
   )
);
?>

<style type="text/css">
.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br{z-index: 1000000 !important;}
</style>
<div  style="display: none;">
<?php
	$servicios = Servicio::model()->findAll();
	foreach ($servicios as $val){
	    echo $this->renderPartial('asigna', array('model'=>$val));
	}
?>
</div>