<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'tbl_job_list';

// Table's primary key
$primaryKey = 'idtbl_job_list';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`u`.`idtbl_job_list`', 'dt' => 'idtbl_job_list', 'field' => 'idtbl_job_list' ),
	array( 'db' => '`u`.`start_date`', 'dt' => 'start_date', 'field' => 'start_date' ),
		array(
		'db' => '`u`.`start_time`',
		'dt' => 'start_time',
		'field' => 'start_time',
		'formatter' => function($d, $row) {
			return date("g:i A", strtotime($d)); 
		}
	),
	array(
    'db' => '`u`.`end_time`',
    'dt' => 'end_time',
    'field' => 'end_time',
    'formatter' => function($d, $row) {
        return date("g:i A", strtotime($d)); 
    }
	),
	array( 'db' => '`ua`.`itenary_type`', 'dt' => 'itenary_type', 'field' => 'itenary_type' ),
	array( 'db' => '`u`.`task`', 'dt' => 'task', 'field' => 'task' ),
	array( 'db' => '`ud`.`name`', 'dt' => 'location', 'field' => 'name' ),
	array( 'db' => '`ub`.`itenary_category`', 'dt' => 'itenary_category', 'field' => 'itenary_category' ),
	array( 'db' => '`uc`.`group`', 'dt' => 'group', 'field' => 'group' ),
	array( 'db' => '`u`.`itenary`', 'dt' => 'itenary', 'field' => 'itenary' ),
	array( 'db' => '`u`.`meet_location`', 'dt' => 'meet_location', 'field' => 'meet_location' ),
    array( 'db' => '`u`.`status`', 'dt' => 'status', 'field' => 'status' ),
	array( 'db' => '`u`.`confirmation`', 'dt' => 'confirmation', 'field' => 'confirmation' ),
	array( 'db' => '`u`.`edit_request`', 'dt' => 'edit_request', 'field' => 'edit_request' )
    //array( 'db' => '`u`.`completion`', 'dt' => 'completion', 'field' => 'completion' ),

);

// SQL server connection information
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
$fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : '';
$toDate = isset($_POST['toDate']) ? $_POST['toDate'] : ''; 

$extraWhere = "`u`.`completion` IN (2) AND `confirmation` IN (1)";

if (!empty($year)) {
    $extraWhere .= " AND YEAR(`u`.`start_date`) = '$year'";
}
if (!empty($month)) {
    $extraWhere .= " AND MONTH(`u`.`start_date`) = '$month'";
}

if (!empty($bdm)) {
    $extraWhere .= " AND `u`.`tbl_med_user_id` = '$bdm'";  
}
if (!empty($fromDate)) {
    $extraWhere .= " AND DATE(`u`.`start_date`) >= '" . $fromDate . "'";
}
if (!empty($toDate)) {
    $extraWhere .= " AND DATE(`u`.`start_date`) <= '" . $toDate . "'";
}


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

$joinQuery = "FROM `tbl_job_list` AS `u`
	LEFT JOIN `tbl_itenary_category` AS `ub` ON (`ub`.`idtbl_itenary_category` = `u`.`tbl_itenary_category_id`)
	LEFT JOIN `tbl_itenary_group` AS `uc` ON (`uc`.`tblid_itenary_group` = `u`.`tbl_itenary_group_id`)
	LEFT JOIN `tbl_itenary_type` AS `ua` ON (`ua`.`idtbl_itenary_type` = `u`.`tbl_itenary_type_tblid_itenary_type`)
	LEFT JOIN `tbl_location` AS `ud` ON (`ud`.`idtbl_location` = `u`.`tblid_location`)";
	

echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
