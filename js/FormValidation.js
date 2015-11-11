
$(function(){
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

jQuery(function($){
	   $("#phoneNumber").mask("(999) 999-9999");
	   $("#zip").mask("99999");
	   
	});