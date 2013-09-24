<?php
/* @var $this OrdenController */
/* @var $model Orden */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orden-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Orden</h1>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
</div><!-- search-form -->

<?php
if(isset($ordenes)){
    $dataProvider=new CArrayDataProvider($ordenes, array(
        'id'=>'ordenes',
        'sort'=>array(
            'attributes'=>array(
                 'k_idOrden', 'fchIngreso','k_idUsuario','fchEntrega','estado'
            ),
        ),
        'keys'=>array('k_idOrden','k_idUsuario', 'fchIngreso','fchEntrega','n_Observaciones','estado'),
        'pagination'=>array(
            'pageSize'=>15,
        ),
    ));
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'orden-grid',
        'dataProvider' => $dataProvider,
        'filter' => $model,
        'ajaxUrl'=>Yii::app()->createAbsoluteUrl("Orden/".$method),
        'columns' => array(
            'k_idOrden',
            array(
                'name' => 'k_idUsuario',
                'filter' => CHtml::listData(Users::model()->findAll(), 'id', 'username'),
                'value' => 'Users::Model()->FindByPk($data->k_idUsuario)->username',
            ),
            'fchIngreso',
            'fchEntrega',
            'n_Observaciones',
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}',
            ),
        ),
    ));
}else{
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'orden-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'k_idOrden',
            array(
                'name' => 'k_idUsuario',
                'filter' => CHtml::listData(Users::model()->findAll(), 'id', 'username'), // fields from country table
                'value' => 'Users::Model()->FindByPk($data->k_idUsuario)->username',
            ),
            'fchIngreso',
            'fchEntrega',
            'n_Observaciones',
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}',
            ),
        ),
    ));
}
?>
