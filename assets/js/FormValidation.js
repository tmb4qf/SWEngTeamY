<<<<<<< HEAD
var questions = [{
    id: 'fname',
    isRequired: true,
    error: 'Please enter your first name'
}, {
    id: 'lname',
    isRequired: true,
    error: 'Please enter your last name'
}, {
    id: 'title',
    isRequired: true,
    error: 'Please enter your title'
}, {
	id: 'pawprint',
    isRequired: true,
    error: 'Please enter your pawprint'
}, {
    id: 'emplId',
    isRequired: true,
    error: 'Please enter id'
}, {
    id: 'organization',
    isRequired: true,
    error: 'Please enter your organization'
}, {
    id: 'street',
    isRequired: true,
    error: 'Please enter your address'
}, {
    id: 'street2',
    isRequired: false
}, {
    id: 'city',
    isRequired: true,
    error: 'Please enter your city'
}, {
    id: 'zip',
    isRequired: true,
    error: 'Please enetr your city'
}, {
    id: 'phoneNumber',
    isRequired: true,
    error: 'Please enter your phone number'
}, {
    id: 'studentWorker',
    isRequired: false
}];

function submitForm() {

    $('.errors').remove();

    var errors = false;

    //Validate ferpa score
    if ($('#ferpa').val() < 85 || $('#ferpa').val() > 100) {
        $('#ferpa').after(errorMessage("Unacceptable"));
        errors = true;
    }

    //Vlidate general required fields
    $.each(questions, function() {
        if (this.isRequired && $("#" + this.id).val() == "") {
            $("#" + this.id).after(errorMessage(this.error ? this.error : "Required"));
            errors = true;
        }
    });

    var chks = document.getElementsByName('chk[]');

    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            errors = false;
            break;
        } else {
            $('#checks').after(errorMessage("Unchecked"));
            errors = true;
            break;
        }
    }

    if (errors == true) {
        return false;
    } else {
        return sendToDatabase();
    }
};

jQuery(function($) {
    $("#phoneNumber").mask("(999) 999-9999");
    $("#zip").mask("99999");

});

function errorMessage(message) {
    return '<span class="text-danger">' + message + '</span>';
}

function sendToDatabase() {
	var data = {};
	$.each(questions, function(){
		data[this.id] = $("#"+this.id).val();
	});
	console.log(data);

	var url = "/index.php/HomePageController/checkUserData";
	$.ajax({
	  	type: "POST",
	  	url: url,
	  	data: data
	});
}
=======

$(function(){
                //$("#phoneNumber").mask("(999) 999-9999");
                //$("#zip").mask("99999");
    
		$('#submit').click(function(){
			
			$('.errors').remove();
			
			var errors = false;
			
			if($('#ferpa').val() < 85){
				$('#ferpa').after('<span class="errors">Unacceptable</span>');
				errors = true;
			}
			
			if($('#username').val() == ""){
				$('#username').after('<span class="errors">Enter Legal Name</span>');
				errors = true;
			}
			
			
			if($('#pawprint').val() == ""){
				$('#pawprint').after('<span class="errors">Enter Pawprint</span>');
				errors = true;
			}
			
			if($('#emplId').val() == ""){
				$('#emplId').after('<span class="errors">Enter Employee ID</span>');
				errors = true;
			}
			
			if($('#title').val() == ""){
				$('#title').after('<span class="errors">Enter Title</span>');
				errors = true;
			}
			
			if($('#organization').val() == ""){
				$('#organization').after('<span class="errors">Enter Organization</span>');
				errors = true;
			}
			
			if($('#street').val() == ""){
				$('#street').after('<span class="errors">Enter Street</span>');
				errors = true;
			}
			
			if($('#city').val() == ""){
				$('#city').after('<span class="errors">Enter City</span>');
				errors = true;
			}
			
			if($('#zip').val() == ""){
				$('#zip').after('<span class="errors">Enter Zip</span>');
				errors = true;
			}
			
			if($('#phoneNumber').val() == ""){
				$('#phoneNumber').after('<span class="errors">Enter Phone Number</span>');
				errors = true;
			}
			
			
			var chks = document.getElementsByName('chk[]');
			
			for(var i = 0; i < chks.length; i++){
				if(chks[i].checked){
					errors = false;
					break;
				}
				else{
					$('#checks').after('<span class="errors">Unchecked</span>');
					errors = true;
					break;
				}
			}
			
			if(errors == true){
				return false;
			}else{
				return true;
			}
	
		});
	});

//$(function(){
//	   $("#phoneNumber").mask("(999) 999-9999");
//	   $("#zip").mask("99999");
//	   
//	});
>>>>>>> Jrf5x8_final
