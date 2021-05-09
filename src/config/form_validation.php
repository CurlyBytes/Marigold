<?php
//https://www.generacodice.com/en/articolo/2204323/Where+should+I+put+my+form+validation+in+codeigniter+in+fat+model+and+thin+controller+approach%3F
    //array('field' => '', 'label' => '', 'rules' => '')
    function arrayf($field, $label, $rules)
    {
        return array('field' => $field, 'label' => $label, 'rules' => $rules);
    }

    $config = array(
        'locationtype/create' => array(
            arrayf('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric')
        ),
        'locationtype/modify' => array(
            arrayf('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric')
        ),
        'locationtype/remove' => array(
            arrayf('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric')
        )
    );