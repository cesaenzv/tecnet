<?php

class AccessDataRol {

    public function getRolesName(){
        $roles = Rights::getAssignedRoles(Yii::app()->user->Id);
        return array_keys($roles);
    }

    private function canAppend($str, $array) {
        $flag = true;
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] == $str) {
                $flag = false;
            }
        }
        return $flag;
    }

    public function getAccessRules($controller) {
        $actions = array();
        $users = array(Yii::app()->user->name);
        $rol = $this->getRolesName();
        $rol = $rol[0];
        $tasks = Authitemchild::model()->findAll("parent='" . $rol . "'");
        foreach ($tasks as $task) {
            $operations = Authitemchild::model()->findAll("parent='" . $task->child . "'");
            foreach ($operations as $operation) {
                $controllerOperation = explode(".", $operation->child);
                if (strtolower($controller) == strtolower($controllerOperation[0])) {
                    if ($this->canAppend($controllerOperation[1], $actions))
                        $actions[] = $controllerOperation[1];
                }
            }
        }
        if (count($actions) == 0) {
            $rules = array(
                /*  array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions' => $actions,
                  'users' => $users,
                  ), */
                array('deny', // allow admin user to perform 'admin' and 'delete' actions
                    'actions' => $actions,
                    'users' => $users,
                ),
            );
        } else {
            $rules = array(
                  array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions' => $actions,
                  'users' => $users,
                  ), 
            );
        }
        return ($rules);
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

     public function getItems(){
        $menu_items = array();
        $roles = $this->getRolesName();
        foreach($roles as $rol){
            if($rol == 'Guest'){
                return $this->getGenerals($menuitems);
            }
            else{
                if($rol == 'Admin'){
                    $menu_items[] = array( 'label'=>'Rights', 'url'=>array('/rights'),
                                            'visible'=>!Yii::app()->user->isGuest);
                }
                $tasks= Authitemchild::model()->findAll("parent='".$rol."'");
                $menuDenied= array('Paquete Mantenimiento');
                $operationsDenied = array('Update','View','Delete','Index','asignaservicio','asignService','GetServiciosGrid','SearchClient','GetServicioProcesos','GetHistorial');
                foreach ($tasks as $task){
                    $operations = Authitemchild::model()->findAll("parent='".$task->child."'");
                    $labelParent = str_replace( ".*", "",$task->child);
                    if($this->canAppend($labelParent, $menuDenied)){
                        $operations_task = array();
                        foreach($operations as $operation){
                            $url = strtolower(str_replace( ".", "/",$operation->child));
                            $labelSon = explode(".",$operation->child);
                            if($this->canAppend($labelSon[1], $operationsDenied)){
                                $operations_task[] = array('label' => $labelSon[1], 'url' => array($url));                             
                            }                       
                        }
                        if (! empty($operations_task)){
                            $menu_items[] = array('label'=>$labelParent, 'items'=>$operations_task);
                        }
                    }
                }
                
                return $this->getGenerals($menu_items);
            }
        
        }
    }

}

?>
