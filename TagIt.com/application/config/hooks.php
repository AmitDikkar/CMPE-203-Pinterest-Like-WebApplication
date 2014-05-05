<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$hook['post_controller_constructor'] = array(  'class'    => 'MyConfigClass',
                                    'function' => 'MyConfigfunction',
                                    'filename' => 'MyConfigClass.php',
                                    'filepath' => 'hooks');
