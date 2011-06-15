function deleteRow(id) {
	if (confirm("<?php echo $this->translate("areYouSureToDeleteThisElement");?>")) {
		window.location = "<?php echo $this->deleteLink;?>" + id;
		return true;
	} else {
		return false;
	}
}

function deleteList() {
	if (confirm("<?php echo $this->translate("areYouSureToDeleteTheseElements");?>")) {
		return true;
	} else {
		return false;
	}
}