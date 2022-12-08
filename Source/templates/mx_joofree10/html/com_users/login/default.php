<?php 

// no direct access
defined('_JEXEC') or die('Restricted access');

// logged in ?
echo $this->loadTemplate($this->user->get('guest') ? 'login' : 'logout');