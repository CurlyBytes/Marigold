<?php
//https://www.generacodice.com/en/articolo/2204323/Where+should+I+put+my+form+validation+in+codeigniter+in+fat+model+and+thin+controller+approach%3F
    //array('field' => '', 'label' => '', 'rules' => '')
    function arrayf($field, $label, $rules)
    {
        return array('field' => $field, 'label' => $label, 'rules' => $rules);
    }

    $config = array(
        'locationtype/create' => array(
            arrayf('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric_spaces')
        ),
        'locationtype/modify' => array(
            arrayf('locationtypeid', 'LocationId', 'required|exact_length[36]'),
            arrayf('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric_spaces')
        ),
        'locationtype/remove' => array(
            arrayf('locationtypeid', 'LocationId', 'required|exact_length[36]'),
            arrayf('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric_spaces')
        ),
        'region/create' => array(
            arrayf('locationname', 'Region Name', 'required|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__region_name_exist')
        ),
        'region/modify' => array(
            arrayf('locationnameid', 'LocationNameId', 'required|exact_length[36]'),
            arrayf('locationname', 'Region Name', 'required|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__region_name_exist')
        ),
        'region/remove' => array(
            arrayf('locationnameid', 'LocationNameId', 'required|exact_length[36]'),
            arrayf('locationname', 'Region Name', 'required|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__region_name_exist')
        )
    );

$config['error_prefix'] = '<div class="error">';
$config['error_suffix'] = '</div>';