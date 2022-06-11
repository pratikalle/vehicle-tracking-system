<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
function chk_logged_user()
{
    $ci = get_instance();
    $logged_user = $ci->session->uid;
    if(isset($logged_user) && !empty($logged_user)) 
    {
        return true;
    }
    else return false;
}

/*------- Function To Download CSV File -----------*/
function output_csv (&$data, $file_name) {
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=$file_name");
    header("Pragma: no-cache");
    header("Expires: 0");
    
    if (!count($data)) echo '"No Data"';
    else {
        // echoing header of csv
        $row_data = array();
        foreach ($data[0] as $key=>$element) $row_data[] = '"'.str_replace('"','\"',$key).'"';
        echo implode(',', $row_data). "\n";
        
        foreach ($data as &$row) {
            $row_data = array();
            foreach ($row as &$element) $row_data[] = '"'.str_replace('"','\"',$element).'"';
            echo implode(',', $row_data). "\n";
        }
    }
}

/*------- Function To Download CSV File -----------*/
?>