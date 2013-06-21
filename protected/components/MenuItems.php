<?php

class MenuItems{
    
    private function getRolesName(){
        $roles=Rights::getAssignedRoles(Yii::app()->user->Id);
        return array_keys($roles);        
    }

    private function getGenerals($menu){


        $menu[]=array(
                    'url' => Yii::app()->getModule('user')->loginUrl,
                    'label' => Yii::app()->getModule('user')->t("Login"),
                    'visible' => Yii::app()->user->isGuest
                );

        $menu[]=array(
                    'url' => Yii::app()->getModule('user')->logoutUrl,
                    'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')',
                    'visible' => !Yii::app()->user->isGuest
                );                

        return $menu;

    }

    private function getAccessRules(){
        $roles = $this->getRolesName();
        $tasks= Authitemchild::model()->findAll("parent='".$rol."'");
    }

    public function getItems(){
        $menu_items = array();
        $roles = $this->getRolesName();
        foreach($roles as $rol){
            if($rol == 'Guest'){
                return $this->getGenerals($menuitems);
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
                return $this->getGenerals($menu_items);
            }
        
        }
    }
}

?>
