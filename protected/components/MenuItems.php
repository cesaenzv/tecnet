<?php

class MenuItems{
    
    public function getRolesName(){
        $roles=Rights::getAssignedRoles(Yii::app()->user->Id);
        return array_keys($roles);        
    }
    
    public function getItems($menuitems){
        $menu_items = $menuitems;
        $roles = $this->getRolesName();
        foreach($roles as $rol){
            if($rol == 'Guest'){
                return $menuitems;
            }
            else{
                if($rol == 'Admin'){
                    $menu_items[] = array(  'label'=>'Rights', 'url'=>array('/rights'), 
                                            'visible'=>!Yii::app()->user->isGuest);
                }
                $tasks= Authitemchild::model()->findAll("parent='".$rol."'");           
                foreach ($tasks as $task){
                    $operations = Authitemchild::model()->findAll("parent='".$task->child."'");
                    $labelParent = str_replace( ".*", "",$task->child);
                    $operations_task = array();
                    foreach($operations as $operation){                    
                        $url = strtolower(str_replace( ".", "/",$operation->child));
                        $labelSon = explode(".",$operation->child);
                        $operations_task[] = array('label' => $labelSon[1], 'url' => array($url));
                    }                    
                    if (! empty($operations_task)){
                        $menu_items[] = array('label'=>$labelParent, 'items'=>$operations_task);
                    }
                }            
    //        var_dump(Yii::app()->getModule('user')->logoutUrl);
    //        die();
                return $menu_items;
            }
        
        }
    }
}

?>
