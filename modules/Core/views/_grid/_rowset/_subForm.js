function perPage(subFormId) {
	var value = $('#' + subFormId + '-perPage').attr('value');

	window.location = window.location.pathname + '?form=' + subFormId + '&perPage=' + value;
	return false;
}

function checkAll(subFormId) {
	var checked = $('#' + subFormId + '-header-all').attr('checked');
	if (checked === 'checked') {
		$('#' + subFormId + ' td.idCheckbox :checkbox').attr('checked', true);
		$('#' + subFormId + ' td.idCheckboxEven :checkbox').attr('checked', true);
	} else {
		$('#' + subFormId + ' td.idCheckbox :checkbox').attr('checked', false);
		$('#' + subFormId + ' td.idCheckboxEven :checkbox').attr('checked', false);
	}
}




