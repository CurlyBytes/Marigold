<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/


$hook['pre_system'][] = array(
    'class'    => 'DotEnvHook',
    'function' => 'LoadEnvironment',
    'filename' => 'DotEnvHook.php',
    'filepath' => 'hooks',
    'params'   => array()
  );

  $hook['post_controller'][] = array(
    'class' => 'Loq', 
    'function' => 'run',
    'filename' => 'LogQuery.php',
    'filepath' => 'hooks'
  );

 


