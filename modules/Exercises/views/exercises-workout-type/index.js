function deleteRow(id) {
	if (confirm("<?php echo 'areYouSureToDeleteThisElement';?>")) {
		window.location = "<?php echo $delete; ?>" + id;
		return true;
	} else {
		return false;
	}
}

function editRow(id) {
    window.location = "<?php echo $edit; ?>" + id ;
}

function addRow() {
    window.location = "<?php echo $add; ?>";
}

function goBack() {
    window.location = "<?php echo $back; ?>";
}