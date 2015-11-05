
function validateForm() {
    var ferpa = document.getElementById("ferpa").value;
		
		if(ferpa == ""){
			alert("Ferpa score cannot be blank");
			return false;
		}
		
		if (ferpa < 85) {
        alert("Ferpa score cannot be less than 85%");
        return false;
		}
	
	var description = document.getElementById("description").value;
	
		if(description == ""){
			alert("Please describe type of access");
			return false;
		}
		
	}