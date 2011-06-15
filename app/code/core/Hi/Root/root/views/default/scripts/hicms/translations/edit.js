function deleteRow(id) {
	if (confirm("<?php echo $this->translate("areYouSureToDeleteThisElement");?>")) {
		window.location = "<?php echo $this->deleteLink;?>" + id;
		return false;
	} else {
		return false;
	}
}

function goBack() {
    window.location = "<?php echo $this->listLink;?>";
    return false;
}

function add() {
    window.location = "<?php echo $this->addLink;?>";
    return false;
}

