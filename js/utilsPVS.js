function ValidateEmail(emailInput) 
{
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  	return re.test(emailInput);
}

function ValidateConfirmPassword(password, confirmPassword) {
	if(password != confirmPassword) {
		return false;
	} else {
		return true;
	}
}

function ValidateDateOfBirthday(birthday) {
		var parts = birthday.split("-");
		var dateOfBirthday = new Date(parts[0] + '/' + parts[1] + '/' + parts[2]);
		var currentDate = new Date();
		var age = currentDate.getFullYear() - dateOfBirthday.getFullYear();
		if(age > 18 && age <= 80) {
			return true;
		} else if(age == 18){
			var months = currentDate.getMonth() - dateOfBirthday.getMonth();
			if (months >= 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
}

function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}