function deleteRow(id) {
    if (confirm("<?php echo $this->translate("areYouSureToDeleteThisElement");?>")) {
        window.location = "<?php echo $this->baseUrl.'/hicms/navigation/delete/id/'?>" + id;
        return true;
    } else {
        return false;
    }
}

function goBack() {
    window.location = "<?php echo $this->baseUrl.'/hicms/navigation/list/'?>";
}

$(document).ready(function(){
//    $('#eNIR .rowContent').hide();
//  
//    $('#eNIR .rowTitle').click(function () {
//        $('#eNIR .rowContent').toggle('slow'); 
//    });
//    
//    $('#eNIER .rowContent').hide();
//  
//    $('#eNIER .rowTitle').click(function () {
//        $('#eNIER .rowContent').toggle('slow'); 
//    });
//    
//    $('#nIEL .listContent').hide();
//  
//    $('#nIEL .listTitle').click(function () {
//        $('#nIEL .listContent').toggle('slow'); 
//    });
//    
//    $('#aNIR .rowContent').hide();
//  
//    $('#aNIR .rowTitle').click(function () {
//        $('#aNIR .rowContent').toggle('slow'); 
//    });
//    
    /*$("p").click(function () { 
    //  $(this).slideUp(); 
    });
    $("p").hover(function () {
      $(this).addClass("hilite");
    }, function () {
      $(this).removeClass("hilite");
    });*/
    
});





