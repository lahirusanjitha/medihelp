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

// if (isset($_POST['userid'])) {
//     $userid = intval($_POST['userid']); 
// } 

$columns = array(
	array( 'db' => '`u`.`idtbl_job_list`', 'dt' => 'idtbl_job_list', 'field' => 'idtbl_job_list' ),
	array( 'db' => '`u`.`start_date`', 'dt' => 'start_date', 'field' => 'start_date' ),
	array( 'db' => '`u`.`start_time`', 'dt' => 'start_time', 'field' => 'start_time' ),
	array( 'db' => '`u`.`end_time`', 'dt' => 'end_time', 'field' => 'end_time' ),
	array( 'db' => '`ua`.`itenary_type`', 'dt' => 'itenary_type', 'field' => 'itenary_type' ),
	array( 'db' => '`u`.`task`', 'dt' => 'task', 'field' => 'task' ),
	array( 'db' => '`ud`.`name`', 'dt' => 'location', 'field' => 'name' ),
	array( 'db' => '`ub`.`itenary_category`', 'dt' => 'itenary_category', 'field' => 'itenary_category' ),
	array( 'db' => '`uc`.`group`', 'dt' => 'group', 'field' => 'group' ),
	array( 'db' => '`u`.`itenary`', 'dt' => 'itenary', 'field' => 'itenary' ),
	array( 'db' => '`u`.`meet_location`', 'dt' => 'meet_location', 'field' => 'meet_location' ),
    array( 'db' => '`u`.`status`', 'dt' => 'status', 'field' => 'status' ),
	array( 'db' => '`u`.`confirmation`', 'dt' => 'confirmation', 'field' => 'confirmation' ),
	array( 'db' => '`u`.`edit_request`', 'dt' => 'edit_request', 'field' => 'edit_request' ),
	array( 'db' => '`u`.`tbl_med_user_id`', 'dt' => 'tbl_med_user_id', 'field' => 'tbl_med_user_id' ),
	array( 'db' => '`u`.`feedback`', 'dt' => 'feedback', 'field' => 'feedback' ),
    array( 'db' => '`u`.`postponed_request`', 'dt' => 'postponed_request', 'field' => 'postponed_request' ),
    array( 'db' => '`u`.`cancel_request`', 'dt' => 'cancel_request', 'field' => 'cancel_request' ),
    array( 
        'db' => '`u`.`completion`', 
        'dt' => 'actions', 
        'field' => 'completion', 
        'formatter' => function($completion, $row) {
            $confirmation = $row['confirmation'];
            $status = $row['status'];
            $postponed_request = $row['postponed_request'];
            $edit_request = $row['edit_request'];
            $cancel_request = $row['cancel_request'];
    
            if ($status == 1 && $confirmation == 3 && $completion == 2) {
                return '<span class="badge badge-danger">Canceled</span>';
            }
    
            if ($confirmation == 1 && $status == 2) {
                return '<span class="badge badge-info">Postponed</span>';
            }

            if ($confirmation == 1 && $postponed_request == 1) {
                return '<span class="badge badge-warning">Posponed Requested</span>';
            }
    
            if ($confirmation == 1 && $edit_request == 1) {
                return '<span class="badge badge-primary">Edit Requested</span>';
            }
            if ($confirmation == 1 && $cancel_request == 1) {
                return '<span class="badge badge-danger">Cancel Requested</span>';
            }

            if ($completion == 1) {
                return '<span class="badge badge-success">Completed</span>';
            } elseif ($confirmation == 2) {
                return '<span class="badge badge-secondary">Not Approved Yet</span>';
            } elseif ($confirmation == 1) {
                return '<span class="badge badge-primary">Approved</span>';
            } elseif ($confirmation == 3) {
                return '<span class="badge badge-danger">Canceled</span>';
            } elseif ($status == 2) {
                return '<span class="badge badge-info">Postponed</span>';
            }
    
            return '<span class="badge badge-secondary">Unknown</span>';
        } 
    )
	

);

// SQL server connection information
require('config.php');
$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
);

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
	

	$extraWhere = "`u`.`status` IN (1, 2) AND `u`.`approval_send` IN(3)  AND `u`.`confirmation` IN(1) AND `u`.`postponed_request` IN(1) OR `u`.`cancel_request` IN(1) OR `u`.`edit_request` IN(1)";

echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);




