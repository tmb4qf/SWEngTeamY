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
