var fields = [
'order',
'elapsed_time',
'speed',
'angle',
'level',
'lifting_series_1_count',
'lifting_series_2_count',
'lifting_series_3_count',
'lifting_series_4_count',
'lifting_series_5_count',
'lifting_series_6_count',
'lifting_series_1_break',
'lifting_series_2_break',
'lifting_series_3_break',
'lifting_series_4_break',
'lifting_series_5_break',
'lifting_series_6_break',
'lifting_series_1_weight',
'lifting_series_2_weight',
'lifting_series_3_weight',
'lifting_series_4_weight',
'lifting_series_5_weight',
'lifting_series_6_weight',
'hiit_speed_low',
'hiit_speed_high',
'hiit_time_low',
'hiit_time_high',
'hiit_warmup_time',
'hiit_interval_count',
'distance',
'avg_rpm',
'exercise_calories_burned'         
];
//alert('dada');
//
var formTypesToFields = [];
formTypesToFields['<?php echo Exercises\Model\DbTable\WorkoutExerciseType::FORM_TYPE_TREADMILL;?>'] = [
        'order',
        'elapsed_time',
        'speed',
        'angle',
        'distance' ,
        'exercise_calories_burned'   
];
formTypesToFields['F'] = [];
formTypesToFields['<?php echo Exercises\Model\DbTable\WorkoutExerciseType::FORM_TYPE_LIFTING;?>'] = [
'order',
'lifting_series_1_count',
'lifting_series_2_count',
'lifting_series_3_count',
'lifting_series_4_count',
'lifting_series_5_count',
'lifting_series_6_count',
'lifting_series_1_break',
'lifting_series_2_break',
'lifting_series_3_break',
'lifting_series_4_break',
'lifting_series_5_break',
'lifting_series_6_break',
'lifting_series_1_weight',
'lifting_series_2_weight',
'lifting_series_3_weight',
'lifting_series_4_weight',
'lifting_series_5_weight',
'lifting_series_6_weight',
'exercise_calories_burned'   
];

formTypesToFields['<?php echo Exercises\Model\DbTable\WorkoutExerciseType::FORM_TYPE_HIIT_TREADMILL;?>'] = [
                                                                                                            'order',
                                                                                                            'elapsed_time',

                                                                                                            'hiit_speed_low',
                                                                                                            'hiit_speed_high',
                                                                                                            'hiit_time_low',
                                                                                                            'hiit_time_high',
                                                                                                            'hiit_warmup_time',
                                                                                                            'hiit_interval_count',
                                                                                                            'exercise_calories_burned',
                                                                                                            'distance'
                                                                                               ];

formTypesToFields['<?php echo Exercises\Model\DbTable\WorkoutExerciseType::FORM_TYPE_ORBITREK;?>'] = [
   'order',
   'elapsed_time',
   'speed',
   'level',
   'exercise_calories_burned',
   'distance'
                                                                                               ];

formTypesToFields['<?php echo Exercises\Model\DbTable\WorkoutExerciseType::FORM_TYPE_STRECHING;?>'] = [
'order',                                                                                                       
'elapsed_time',
'exercise_calories_burned'   
];

formTypesToFields['<?php echo Exercises\Model\DbTable\WorkoutExerciseType::FORM_TYPE_BIKE;?>'] = [
   'order',
   'elapsed_time',
   'avg_rpm',
   'level',
   'exercise_calories_burned',
   'distance'
                                                                                               ];
//
var selectOptionsToFormTypes = [];
selectOptionsToFormTypes['0'] = 'F';

<?php if(is_array($formTypesData)) :?>
<?php $count = count($formTypesData); $i = 1; foreach($formTypesData as $index => $value ): ?>
    selectOptionsToFormTypes['<?php echo $value['type_id'];?>'] = <?php echo $value['form_type'];?>;
<?php endforeach ;?>
<?php endif ;?>



var lastOfType = [];
<?php if(is_array($lastOfTypeData)) :?>
<?php $count = count($lastOfTypeData); $i = 1; foreach($lastOfTypeData as $index => $value ): ?>

	var typeTmp = [];
	<?php if(is_array($value)) :?>
	<?php $count = count($value); $i = 1; foreach($value as $col => $data ): ?>
	    typeTmp['<?php echo $col;?>'] =  '<?php echo $data;?>';
	<?php endforeach ;?>
	<?php endif ;?>
	
    lastOfType['<?php echo $index;?>'] = typeTmp;
    
<?php endforeach ;?>
<?php endif ;?>




function hideAll() {
	$.each(fields, function(index, value) { 
	  var element = $('#WorkoutExerciseRow-row-' + value);
	  element.parent().parent().css('display', 'none');
	});
}




$(document).ready(function() {

	var fieldsToShow = formTypesToFields[selectOptionsToFormTypes[document.getElementById('WorkoutExerciseRow-row-type_id').selectedIndex]]

	if (fieldsToShow) {

		hideAll();
		$.each(fieldsToShow, function(index, value) { 
		  var element = $('#WorkoutExerciseRow-row-' + value);
		  element.parent().parent().css('display', 'table-row');
		});
	}

 });



function exerciseType(select) {
	var fieldsToShow = formTypesToFields[selectOptionsToFormTypes[select.selectedIndex]]

	if (fieldsToShow) {
		hideAll();
		$.each(fieldsToShow, function(index, value) { 
			  var element = $('#WorkoutExerciseRow-row-' + value);
			  element.parent().parent().css('display', 'table-row');
			});
	}
}

function goBack() {
    window.location = "<?php echo $back;?>";
}
function copy() {
	//window.location = "<?php echo $back;?>";
	alert(document.getElementById('WorkoutExerciseRow-row-type_id').selectedIndex);
	var fieldsOfLast = lastOfType[document.getElementById('WorkoutExerciseRow-row-type_id').selectedIndex];
	alert(fieldsOfLast);
	$.each(fieldsOfLast, function(index, value) { 
		alert(index + ' ' + value);
		  //var element = $('#WorkoutExerciseRow-row-' + value);
		  //element.parent().parent().css('display', 'table-row');
		});
}