<?php

require_once('../../database/utility.php');
require_once('../../database/dbhelper.php');


if(!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'confirm':
			confirmInvoice();
			break;
        case 'reject':
            rejectInvoice();
            break;
	}
}

function confirmInvoice() {
	$id = getPost('id');

	$confirmSQL = "UPDATE `order`
    SET `status` = 2
    WHERE `id` = $id";

    execute($confirmSQL);
}

function rejectInvoice(){
    $id = getPost('id');

	$rejectSQL = "UPDATE `order`
    SET `status` = 3
    WHERE `id` = $id";

    execute($rejectSQL);
}

?>