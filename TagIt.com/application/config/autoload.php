<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$autoload['packages'] = array(APPPATH.'third_party');

$autoload['libraries'] = array('session', 'database','site_configurations', 'tweet','sitelogin','tank_auth');

$autoload['helper'] = array('url','pinterest_helper');


$autoload['config'] = array('config','email');



$autoload['language'] = array();



$autoload['model'] = array('board_model','editprofile_model','login_model','action_model','admin_model');

