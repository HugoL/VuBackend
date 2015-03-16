<?php
Yii::import('zii.widgets.CPortlet');
 
class UserMenu extends CPortlet
{
	public $id_usuario;

    public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
    	
        $this->render('userMenu');
    }
}
?>