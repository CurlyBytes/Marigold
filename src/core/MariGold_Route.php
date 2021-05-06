<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//https://avenir.ro/how-to-make-truly-seo-urls-in-codeigniter-without-duplicate-content-on-underscore-urls/
class MariGold_Route extends CI_Router {
    function __construct()
    {
        parent::__construct();
    } 
 
    // --------------------------------------------------------------------
 
    /**
     * Set request route
     *
     * Takes an array of URI segments as input and sets the class/method
     * to be called.
     *
     * @used-by	CI_Router::_parse_routes()
     * @param	array	$segments	URI segments
     * @return	void
     */
    protected function _set_request($segments = array())
    {
        $segments = $this->_validate_request($segments);
        // If we don't have any segments left - try the default controller;
        // WARNING: Directories get shifted out of the segments array!
        if (empty($segments))
        {
            $this->_set_default_controller();
            return;
        }
 
        if ($this->translate_uri_dashes === TRUE)
        {
            if(strpos($segments[0],'_')!==FALSE)
            {
                $wrong_controller = TRUE;
            }
            $segments[0] = str_replace('-', '_', $segments[0]);
 
            if(isset($segments[1]) && strpos($segments[1],'_')!==FALSE)
            {
                $wrong_method = TRUE;
            }
            if (isset($segments[1]))
            {
                $segments[1] = str_replace('-', '_', $segments[1]);
            }
        }
 
        if(isset($wrong_controller) || isset($wrong_method))
        {
            $url_segments = $segments;
            $url = $this->config->config['base_url'];
            $controller = array_shift($url_segments);
            $url .= str_replace('_','-',$controller);
            if(isset($url_segments) && sizeof($url_segments)>0) {
                $method = array_shift($url_segments);
                $url .= '/' . str_replace('_', '-', $method);
            }
            if(!empty($url_segments))
            {
                $url .= '/'.implode('/',$url_segments);
            }
            header('Location: '.$url, TRUE, 301);
        }
 
        $this->set_class($segments[0]);
        if (isset($segments[1]))
        {
            $this->set_method($segments[1]);
        }
        else
        {
            $segments[1] = 'index';
        }
 
        array_unshift($segments, NULL);
        unset($segments[0]);
        $this->uri->rsegments = $segments;
    }
}