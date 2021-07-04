<?php
//https://www.generacodice.com/en/articolo/2204323/Where+should+I+put+my+form+validation+in+codeigniter+in+fat+model+and+thin+controller+approach%3F
    //array('field' => '', 'label' => '', 'rules' => '')
    function arrayf($field, $label, $rules)
    {
        return array('field' => $field, 'label' => $label, 'rules' => $rules);
    }

    $config = array(
        'locationtype/create' => array(
            arrayf('locationtype', 'Location Type', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces')
        ),
        'locationtype/modify' => array(
            arrayf('locationtypeid', 'LocationId', 'required|exact_length[36]'),
            arrayf('locationtype', 'Location Type', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces')
        ),
        'locationtype/remove' => array(
            arrayf('locationtypeid', 'LocationId', 'required|exact_length[36]'),
            arrayf('locationtype', 'Location Type', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces')
        ),
        'region/create' => array(
            arrayf('locationname', 'Region Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__region_name_exist')
        ),
        'region/modify' => array(
            arrayf('locationnameid', 'LocationNameId', 'required|exact_length[36]'),
            arrayf('locationname', 'Region Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__region_name_modify_exist')
        ),
        'region/remove' => array(
            arrayf('locationnameid', 'LocationNameId', 'required|exact_length[36]'),
            arrayf('locationname', 'Region Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__has_location_name_has_child')
        ),
        'district/create' => array(
            arrayf('locationnameidparent', 'Region Name', 'required|exact_length[36]|callback__region_name_exist'),
            arrayf('locationname', 'District Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__district_name_exist')
        ),
        'district/modify' => array(
            arrayf('locationnameid', 'LocationNameId', 'required|exact_length[36]'),
            arrayf('locationgroupid', 'locationgroupid', 'required|exact_length[36]|callback__group_location_id_exist'),
            arrayf('locationnameidparent', 'Region Name', 'required|exact_length[36]|callback__region_name_exist'),
            arrayf('locationname', 'District Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__district_name_exist')
        ),
        'district/remove' => array(
            arrayf('locationnameid', 'LocationNameId', 'required|exact_length[36]'),
            arrayf('locationgroupid', 'locationgroupid', 'required|exact_length[36]|callback__group_location_id_exist'),
            arrayf('locationnameidparent', 'Region Name', 'required|exact_length[36]|callback__region_name_exist'),
            arrayf('locationname', 'District Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__has_location_name_has_child')
        ),
        'area/create' => array(
            arrayf('locationnameidparent', 'District Name', 'required|exact_length[36]|callback__district_name_exist'),
            arrayf('locationname', 'Area Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__area_name_exist')
        ),
        'area/modify' => array(
            arrayf('locationnameid', 'LocationNameId', 'required|exact_length[36]'),
            arrayf('locationgroupid', 'locationgroupid', 'required|exact_length[36]|callback__group_location_id_exist'),
            arrayf('locationnameidparent', 'District Name', 'required|exact_length[36]|callback__district_name_exist'),
            arrayf('locationname', 'Area Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__area_name_exist')
        ),
        'area/remove' => array(
            arrayf('locationnameid', 'LocationNameId', 'required|exact_length[36]'),
            arrayf('locationgroupid', 'locationgroupid', 'required|exact_length[36]|callback__group_location_id_exist'),
            arrayf('locationnameidparent', 'District Name', 'required|exact_length[36]|callback__district_name_exist'),
            arrayf('locationname', 'Area Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__has_location_name_has_child')
        ),
        'branch/create' => array(
            arrayf('locationnameidparent', 'Area Name', 'required|exact_length[36]|callback__area_name_exist'),
            arrayf('locationname', 'Branch Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__branch_name_exist')
        ),
        'branch/modify' => array(
            arrayf('locationnameid', 'LocationNameId', 'required|exact_length[36]'),
            arrayf('locationgroupid', 'locationgroupid', 'required|exact_length[36]|callback__group_location_id_exist'),
            arrayf('locationnameidparent', 'Area Name', 'required|exact_length[36]|callback__area_name_exist'),
            arrayf('locationname', 'Branch Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__branch_name_exist')
        ),
        'branch/remove' => array(
            arrayf('locationnameid', 'LocationNameId', 'required|exact_length[36]'),
            arrayf('locationgroupid', 'locationgroupid', 'required|exact_length[36]|callback__group_location_id_exist'),
            arrayf('locationnameidparent', 'Area Name', 'required|exact_length[36]|callback__area_name_exist'),
            arrayf('locationname', 'Branch Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__has_location_name_has_child')
        ),
        'propose-branch/create' => array(
            arrayf('branchid', 'Branch Name', 'required|exact_length[36]|callback__branch_name_exist'),
            arrayf('latitude', 'Latitude', 'required|trim|callback__valid_latitude|callback__unique_coordinates'),
            arrayf('longtitude', 'Longtitude', 'required|trim|callback__valid_longtitude|callback__unique_coordinates'),
            arrayf('openingdate', 'Opening Date', 'required|trim|callback__valid_date[Y-m]'),
            arrayf('branchlocation', 'Branch Location', 'required|trim|min_length[4]|max_length[250]|alpha_numeric_spaces'),

            arrayf('otherdetails', 'OtherDetails', 'required|trim|min_length[4]|max_length[450]'),
            arrayf('rentalprice', 'Rental Price', 'required|trim|numeric'),
            arrayf('files', 'Branch Images', 'callback__file_check')
        ),
        'propose-branch/photo-replace' => array(
            arrayf('branchinformationid', 'BranchInformationId', 'required|exact_length[36]'),
            arrayf('files', 'Branch Images', 'callback__file_check')
        ),
        'propose-branch/modify' => array(
            arrayf('branchinformationid', 'BranchInformationId', 'required|exact_length[36]|callback__primarykey_exist[BranchInformation]'),
            arrayf('branchinformationdetailid', 'BranchInformationDetailId', 'required|exact_length[36]|callback__primarykey_exist[BranchInformationDetail]'),
            arrayf('branchid', 'Branch Name', 'required|exact_length[36]|callback__branch_name_exist'),
            arrayf('latitude', 'Latitude', 'required|trim|callback__valid_latitude'),
            arrayf('longtitude', 'Longtitude', 'required|trim|callback__valid_longtitude'),
            arrayf('openingdate', 'Opening Date', 'required|trim|callback__valid_date[Y-m]'),
            arrayf('branchlocation', 'Branch Location', 'required|trim|min_length[4]|max_length[250]|alpha_numeric_spaces'),
          
            arrayf('otherdetails', 'OtherDetails', 'required|trim|min_length[4]|max_length[450]'),
            arrayf('rentalprice', 'Rental Price', 'required|trim|numeric')
        ),
        'propose-branch/remove' => array(
            arrayf('branchinformationid', 'BranchInformationId', 'required|exact_length[36]|callback__primarykey_exist[BranchInformation]'),
            arrayf('branchinformationdetailid', 'BranchInformationDetailId', 'required|exact_length[36]|callback__primarykey_exist[BranchInformationDetail]'),
            arrayf('branchid', 'Branch Name', 'required|exact_length[36]|callback__branch_name_exist'),
            arrayf('latitude', 'Latitude', 'required|trim|callback__valid_latitude'),
            arrayf('longtitude', 'Longtitude', 'required|trim|callback__valid_longtitude'),
            arrayf('openingdate', 'Opening Date', 'required|trim|callback__valid_date[Y-m]'),
            arrayf('branchlocation', 'Branch Location', 'required|trim|min_length[4]|max_length[250]|alpha_numeric_spaces'),

            arrayf('otherdetails', 'OtherDetails', 'required|trim|min_length[4]|max_length[450]'),
            arrayf('rentalprice', 'Rental Price', 'required|trim|numeric')
        ),
        'branch-expansion' => array(
            arrayf('openingdate', 'Opening Date', 'required|trim|callback__valid_date[Y-m]')
        ),
        'propose-branch/create-isp' => array(
            arrayf('branchinformationid', 'BranchInformationId', 'required|exact_length[36]|callback__primarykey_exist[BranchInformation]'),
            arrayf('internetserviceprovidername', 'Internet SErvice Provider Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__is_unique_internetserviceprovidername|callback__maximum_ispprovider'),
            arrayf('internetservicetechnologytype', 'internetservicetechnologytype', 'required'),
            arrayf('speed', 'Speed', 'required|trim|numeric')
        ),
        'propose-branch/modify-isp' => array(
            arrayf('branchinformationid', 'BranchInformationId', 'required|exact_length[36]|callback__primarykey_exist[BranchInformation]'),
            arrayf('internetserviceproviderid', 'InternetServiceProviderId', 'required|exact_length[36]|callback__primarykey_exist[InternetServiceProvider]'),
            arrayf('internetserviceprovidername', 'Internet SErvice Provider Name', 'required|trim|min_length[2]|max_length[70]|alpha_numeric_spaces|callback__is_unique_internetserviceprovidername_edit'),
            arrayf('internetservicetechnologytype', 'internetservicetechnologytype', 'required'),
            arrayf('speed', 'Speed', 'required|trim|numeric')
        ),
        'propose-branch/remove-isp' => array(
            arrayf('branchinformationid', 'BranchInformationId', 'required|exact_length[36]|callback__primarykey_exist[BranchInformation]'),
            arrayf('internetserviceproviderid', 'InternetServiceProviderId', 'required|exact_length[36]|callback__primarykey_exist[InternetServiceProvider]')
        ),
        'propose-branch/approve' => array(
            arrayf('branchinformationid', 'BranchInformationId', 'required|exact_length[36]|callback__primarykey_exist[BranchInformation]|callback__has_minimumimages|callback__has_minimumbranchproposal|callback__has_minimum_internetserviceprovider')
        ),
    );

    $config['error_prefix']= '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><div class="alert-message">';
    $config['error_suffix']  = '</div></div>';         
      

