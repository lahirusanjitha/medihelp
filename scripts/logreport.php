<?php

// DB table to use
$table = 'tbl_sendtoapproval';

// Table's primary key
$primaryKey = 'idtbl_sendtoapproval';

$columns = array(
    array( 'db' => '`sa`.`idtbl_sendtoapproval`', 'dt' => 'idtbl_sendtoapproval', 'field' => 'idtbl_sendtoapproval' ),
    array( 'db' => '`u`.`start_date`', 'dt' => 'start_date', 'field' => 'start_date' ),
    array( 'db' => '`u`.`start_time`', 'dt' => 'start_time', 'field' => 'start_time' ),
    array(
        'db' => '`u`.`start_time`',
        'dt' => 'time_range',
        'field' => 'start_time',
        'formatter' => function($start_time, $row) {
            return $start_time . ' - ' . $row['end_time'];
        }
    ),
    array( 'db' => '`ua`.`itenary_type`', 'dt' => 'itenary_type', 'field' => 'itenary_type' ),
    array( 'db' => '`ub`.`itenary_category`', 'dt' => 'itenary_category', 'field' => 'itenary_category' ),
    array( 'db' => '`uc`.`group`', 'dt' => 'group', 'field' => 'group' ),
    array( 'db' => '`u`.`itenary`', 'dt' => 'itenary', 'field' => 'itenary' ),
    array( 'db' => '`u`.`instertdatetime`', 'dt' => 'instertdatetime', 'field' => 'instertdatetime' ),
    array( 'db' => '`sa`.`datetime`', 'dt' => 'datetime', 'field' => 'datetime' ), // send to approval time
    array( 'db' => '`ap`.`approvedatetime`', 'dt' => 'approvedatetime', 'field' => 'approvedatetime' ),
    array( 'db' => '`rd`.`rejecteddatetime`', 'dt' => 'rejecteddatetime', 'field' => 'rejecteddatetime' ),
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

$extraWhere = "`u`.`status` IN (1, 2)";

if (!empty($year)) {
    $extraWhere .= " AND YEAR(`u`.`start_date`) = '$year'";
}
if (!empty($month)) {
    $extraWhere .= " AND MONTH(`u`.`start_date`) = '$month'";
}

if (!empty($bdm)) {
    $extraWhere .= " AND `u`.`tbl_med_user_id` = '$bdm'";  
}


error_log("ExtraWhere Clause: $extraWhere");
$joinQuery = "FROM `tbl_sendtoapproval` AS `sa`
    LEFT JOIN `tbl_job_list` AS `u` ON `sa`.`tbl_joblist_idtbl_joblist` = `u`.`idtbl_job_list`
    LEFT JOIN `tbl_approval_list` AS `ap` ON `ap`.`tbl_sendtoapproval_id` = `sa`.`idtbl_sendtoapproval`
    LEFT JOIN `tbl_rejected_itinary` AS `rd` ON `rd`.`tbl_sendtoapproval_id` = `sa`.`idtbl_sendtoapproval`
    LEFT JOIN `tbl_itenary_type` AS `ua` ON `ua`.`idtbl_itenary_type` = `u`.`tbl_itenary_type_tblid_itenary_type`
    LEFT JOIN `tbl_itenary_group` AS `uc` ON `uc`.`tblid_itenary_group` = `u`.`tbl_itenary_group_id`
    LEFT JOIN `tbl_itenary_category` AS `ub` ON `ub`.`idtbl_itenary_category` = `u`.`tbl_itenary_category_id`";


require('ssp.customized.class.php');

echo json_encode(
    SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
