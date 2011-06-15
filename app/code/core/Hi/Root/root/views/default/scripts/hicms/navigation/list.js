function deleteRow(id) {
	if (confirm("<?php echo $this->translate("areYouSureToDeleteThisElement");?>")) {
		window.location = "<?php echo $this->baseUrl.'/hicms/navigation/delete/id/'?>" + id;
		return true;
	} else {
		return false;
	}
}

function editRow(id) {
    window.location = "<?php echo $this->baseUrl.'/hicms/navigation/edit/id/'?>" + id + "/";
}

function addRow() {
    window.location = "<?php echo $this->baseUrl.'/hicms/navigation/add/'?>";
}