
<div id="servicio_<?php echo $model->k_idServicio ?>" style="display: none;">
    <table id="list<?php echo $model->k_idServicio ?>"></table> 
    <div id="pager<?php echo $model->k_idServicio ?>"></div>
    <?php
    $serviciosModel = Servicio::model()->findAll();
    $ProductosModel = Producto::model()->findAll();
    $servicios = array();
    $productos = array();
    $servicios[$model->k_idServicio] = $model->n_nomServicio;
    foreach ($ProductosModel as $val) {
        $productos[$val->k_idProducto] = $val->n_nombreProducto;
    }
    ?>
    <script type="text/javascript">
        $(function() {
            $("#list<?php echo $model->k_idServicio ?>").jqGrid({
                url: "<?php echo $this->createUrl('producto/GetServiciosGrid', array('id' => $model->k_idServicio)) ?>",
                datatype: "json",
                mtype: "POST",
                colNames: ["Servicio", "Producto", "Costo"],
                colModel: [
                    { name: "servicio", width: 200,editable:true,hidden:false, edittype: "select", editrules:{edithidden:true, required:true}, editoptions: { value: <?php echo json_encode($servicios); ?>} },
                    { name: "producto", width: 200,editable:true,hidden:false, edittype: "select", editrules:{edithidden:true, required:true}, editoptions: { value: <?php echo json_encode($productos); ?> } },
                    { name: "costo", width: 100, align: "right",editable:true,hidden:false,editrules:{edithidden:true, required:true} },
                ],
                pager: "#pager<?php echo $model->k_idServicio ?>",
                rowNum: 10,
                rowList: [10, 20, 30],
                sortname: "k_producto",
                editurl: "<?php echo $this->createUrl('producto/asignaServicio') ?>",
                sortorder: "desc",
                viewrecords: true,
                gridview: true,
                afterSubmit:function(data,postd){
                    console.log(data);
                    console.log(postd);
                    return {0:true};
                },
                autoencode: true,
                caption: "Asigna Productos al servicio \"<?php echo $model->n_nomServicio; ?>\""
            });
            jQuery("#list<?php echo $model->k_idServicio ?>").jqGrid('navGrid', '#pager<?php echo $model->k_idServicio ?>', {
                edit : true,
                add : true,
                del : true,
                search :false,
                closeAfterEdit: true,
                closeAfterAdd:true,
                afterComplete : function(response, postdata)
                {
                    alert("asdf");
                } 
            });
        });
    </script>
</div>