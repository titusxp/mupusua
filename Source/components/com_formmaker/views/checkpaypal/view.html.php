<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class formmakerViewcheckpaypal extends JView
{
    function display($tpl = null)
    {
		$model = $this->getModel();
		$result = $model->checkpaypal();

        parent::display($tpl);
    }
}
?>