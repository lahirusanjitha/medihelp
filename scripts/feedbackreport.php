<?php

// DB table to use
$table = 'tbl_feedback';

// Table's primary key
$primaryKey = 'idtbl_feedback';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => '`u`.`idtbl_job_list`', 'dt' => 'idtbl_job_list', 'field' => 'idtbl_job_list' ),
    array( 'db' => '`u`.`start_date`', 'dt' => 'start_date', 'field' => 'start_date' ),
    array( 'db' => '`u`.`start_time`', 'dt' => 'start_time', 'field' => 'start_time' ),
    array(
        'db' => '`u`.`start_time`', // Just to ensure it's available
        'dt' => 'time_range',
        'field' => 'start_time',
        'formatter' => function($start_time, $row) {
            return $start_time . ' - ' . $row['end_time'];
        }
    ),
    array( 'db' => '`u`.`end_time`', 'dt' => 'end_time', 'field' => 'end_time' ),
    array( 'db' => '`u`.`task`', 'dt' => 'task', 'field' => 'task' ),
    array( 'db' => '`u`.`itenary`', 'dt' => 'itenary', 'field' => 'itenary' ),
    array( 'db' => '`u`.`meet_location`', 'dt' => 'location', 'field' => 'meet_location' ),
    array( 'db' => '`u`.`status`', 'dt' => 'status', 'field' => 'status' ),
    array( 'db' => '`u`.`confirmation`', 'dt' => 'confirmation', 'field' => 'confirmation' ),
    array( 'db' => '`u`.`edit_request`', 'dt' => 'edit_request', 'field' => 'edit_request' ),
    array( 'db' => '`u`.`completion`', 'dt' => 'completion', 'field' => 'completion' ),
    array( 'db' => '`ue`.`comment`', 'dt' => 'comment', 'field' => 'comment' ),
    array( 'db' => '`ud`.`feedback_type`', 'dt' => 'feedback_type', 'field' => 'feedback_type' ),
    array( 'db' => '`ua`.`itenary_type`', 'dt' => 'itenary_type', 'field' => 'itenary_type' ),
    array( 'db' => '`ub`.`itenary_category`', 'dt' => 'itenary_category', 'field' => 'itenary_category' ),
    array( 'db' => '`uc`.`group`', 'dt' => 'group', 'field' => 'group' )
);


require('config.php');
$sql_details = array(
    'user' => $db_username,
    'pass' => $db_password,
    'db'   => $db_name,
    'host' => $db_host
);

$year = isset($_POST['year']) ? $_POST['year'] : '';  
$month = isset($_POST['month']) ? $_POST['month'] : '';  
$bdm = isset($_POST['bdm']) ? $_POST['bdm'] : '';  

$extraWhere = "`ue`.`tbl_joblist_idtbl_joblist` IS NOT NULL AND `ue`.`is_admin` IN(0)"; 

if (!empty($year)) {
    $extraWhere .= " AND YEAR(`u`.`start_date`) = '$year'";
}
if (!empty($month)) {
    $extraWhere .= " AND MONTH(`u`.`start_date`) = '$month'";
}

if (!empty($bdm)) {
    $extraWhere .= " AND `ue`.`tbl_med_user_idtbl_med_user` = '$bdm'";  
}


error_log("ExtraWhere Clause: $extraWhere");
$joinQuery = "FROM `tbl_feedback` AS `ue`
    LEFT JOIN `tbl_job_list` AS `u` ON (`u`.`idtbl_job_list` = `ue`.`tbl_joblist_idtbl_joblist`)
    LEFT JOIN `tbl_feedback_type` AS `ud` ON (`ud`.`idtbl_feedback_type` = `ue`.`tbl_feedback_type_idtbl_feedback_type`)
    LEFT JOIN `tbl_itenary_type` AS `ua` ON (`ua`.`idtbl_itenary_type` = `u`.`tbl_itenary_type_tblid_itenary_type`)
    LEFT JOIN `tbl_itenary_group` AS `uc` ON (`uc`.`tblid_itenary_group` = `u`.`tbl_itenary_group_id`)
	LEFT JOIN `tbl_itenary_category` AS `ub` ON (`ub`.`idtbl_itenary_category` = `u`.`tbl_itenary_category_id`)";

require('ssp.customized.class.php');

echo json_encode(
    SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
