<?php

class Global_function {

    function insert_into_log_table($id_personil = null, $activity = null) {
        $CI = & get_instance();
        $data = array(
            'id_personil' => $id_personil,
            'activity' => $activity,
            'activity_time' => 'NOW()',
        );
        $parameters = array();
	$parameters[] = $id_personil;
	$parameters[] = $activity;
        $CI->db->query("INSERT INTO log_user (id_personil, activity,activity_time) VALUES (?, ?, NOW())", $parameters);
    }

    function clearFilter($filter)
    {
        return str_replace('"', "\'", str_replace("'", "\'", $filter));
    }

    function idr_currency($number)
    {
        return substr(number_format($number, 2, ',', '.'), 0, -3);
    }

}
