(function(){
  'use strict';
  var count=0;
  $(document).ready(function(){
  	let form = $('.register-form');

  	// On form submit take action, like an AJAX call
    $(form).submit(function(e){
        if(this.checkValidity() == false) {
		$(form).addClass('was-validated');
   			$('#alertmessage').modal('toggle');
			$('#passwordalertmessage').remove();
			$('#error').removeAttr('hidden');
			e.preventDefault();
            e.stopPropagation();
			//$(form).removeClass('was-validated');
        }

    });

    // On every :input focusout validate if empty
    $(':input').blur(function(){
		
    	let fieldType = this.name;
    	switch(fieldType){
			case 'idnumber':
				validateIDNumber($(this));
				break;
			case 'username':
				validateUsername($(this));
				break;
    		case 'password':
            //case 'textarea':
                validatePassword($(this));
                break;
			case 'matchpassword':
				validateMatchPassword($(this));
                break;
    		case 'email':
                validateEmail($(this));
                break;
    		case 'checkbox':
    			validateCheckBox($(this));
    			break;
			case 'phonenumber':
				validatePhonenumber($(this));
				break;
			case 'passportnumber':
				validatePassportNumber($(this));
				break;
			case 'date':
				validateDate($(this));
				break;
			case 'postcode':
				validatePostcode($(this));
				break;
			case 'address':
				validateAddress($(this));
				break;
    		default:
	    		break;
    	}
	});


	// On every :input focusin remove existing validation messages if any
    $(':input').click(function(){
    	$(this).removeClass('is-valid is-invalid');
		//$(this).removeClass('was-validated');
	});

    // On every :input focusin remove existing validation messages if any
    $(':input').keydown(function(){
        $(this).removeClass('is-valid is-invalid');
    });

	// Reset form and remove validation messages
    $(':reset').click(function(){
        $(':input, :checked').removeClass('is-valid is-invalid');
    	$(form).removeClass('was-validated');
    });

  });
	
	
	// Validate Date
    function validateDate(thisObj) {
        let fieldValue = thisObj.val();
		console.log(fieldValue);
		let pattern = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/g;

        if(pattern.test(fieldValue)) {
            $(thisObj).addClass('is-valid');
        } else {
            $(thisObj).addClass('is-invalid');
        }
    }
	
	// Validate Postcode
    function validatePostcode(thisObj) {
        let fieldValue = thisObj.val();
		let pattern = /^(?!^0+$)[a-zA-Z0-9]{5,13}$/g;
        if(pattern.test(fieldValue)) {
            $(thisObj).addClass('is-valid');
        } else {
            $(thisObj).addClass('is-invalid');
        }
    }
	
    // Validate password
    function validatePassword(thisObj) {
        let fieldValue = thisObj.val();
        let pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
        if(pattern.test(fieldValue)) {
            $(thisObj).addClass('is-valid');
        } else {
            $(thisObj).addClass('is-invalid');
        }
    }
	
	// Validate Match Password
    function validateMatchPassword(thisObj) {
		var pw1 = document.getElementById("password").value; 
        var pw2 = thisObj.val();
		var pw3 = document.getElementsByClassName('password');
		let pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
		var pw4 = pattern.test(pw2);
        if(pw1 != pw2) {
            $(thisObj).addClass('is-invalid'); 
		}else{
            $(thisObj).addClass('is-valid');
        }
    }
	
	// Validate Username
    function validateUsername(thisObj) {
        let fieldValue = thisObj.val();
        if(fieldValue.length > 3 && fieldValue.length < 21) {
				 $.ajax({
					url: 'checkaccount.php',
					type: 'post',
					data: {username: fieldValue},
					success: function(response){
					
					var respond = response;
						if(respond == 'Available'){
							$(thisObj).addClass('is-valid');
						}else if(respond == 'Same'){
							$(thisObj).addClass('is-valid');
						}else{
							$(thisObj).addClass('is-invalid');
							$('#defaultmessage').html('');
							$('#message').html('The username already exists. Please try login or choose another username.');
						}

					 }
				 });
        } else {
            $(thisObj).addClass('is-invalid');
			$('#defaultmessage').html('');
			$('#message').html('Please enter a valid username. Your username must be between four and 20 characters only.');
        }
    }
	
	// Validate Address
    function validateAddress(thisObj) {
        let fieldValue = thisObj.val();
        if(fieldValue.length > 3) {
            $(thisObj).addClass('is-valid');
        } else {
            $(thisObj).addClass('is-invalid');
        }
    }
	
	// Validate ID Number
    function validateIDNumber(thisObj) {
        let fieldValue = thisObj.val();
        let pattern = /(([[1-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01]))([0-9]{2})([0-9]{4})/g;

        if(pattern.test(fieldValue)) {
            $.ajax({
					url: 'checkaccount.php',
					type: 'post',
					data: {idnumber: fieldValue},
					success: function(responseidnumber){
					
					var respondidnumber = responseidnumber;
						if(respondidnumber == 'Available'){
							$(thisObj).addClass('is-valid');
						}else{
							$(thisObj).addClass('is-invalid');
							$('#defaultmessageidnumber').html('');
							$('#messageidnumber').html('An account is already registered with your Identification Card number. Please log in');
						}

					 }
				 });
        }else{
            $(thisObj).addClass('is-invalid');
			$('#defaultmessageidnumber').html('');
			$('#messageidnumber').html('Please enter a valid ic number without dash &#39;&#45;&#39;.');
        }
    }
	
	// Validate Passport Number
    function validatePassportNumber(thisObj) {
        let fieldValue = thisObj.val();
        let pattern = /^(?!^0+$)[a-zA-Z0-9]{6,13}$/g;

        if(pattern.test(fieldValue)) {
           $.ajax({
					url: 'checkaccount.php',
					type: 'post',
					data: {passportnumber: fieldValue},
					success: function(responsepassport){
					
					var respondpassport = responsepassport;
						if(respondpassport == 'Available'){
							$(thisObj).addClass('is-valid');
						}else{
							$(thisObj).addClass('is-invalid');
							$('#defaultmessagepassport').html('');
							$('#messagepassport').html('An account is already registered with your passport number. Please log in');
						}

					 }
				 });
        }else{
            $(thisObj).addClass('is-invalid');
			$('#defaultmessagepassport').html('');
			$('#messagepassport').html('Please enter a valid passport number.');
        }
    }

    // Validate Email
    function validateEmail(thisObj) {
        let fieldValue = thisObj.val();
        let pattern = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/i;

        if(pattern.test(fieldValue)) {
             $.ajax({
					url: 'checkaccount.php',
					type: 'post',
					data: {email: fieldValue},
					success: function(responseemail){
					var respondemail = responseemail;
					console.log(respondemail);
						if(respondemail == 'Available' || respondemail == 'Same' ){
							$(thisObj).addClass('is-valid');
						}else{
							$(thisObj).addClass('is-invalid');
							$('#defaultmessageemail').html('');
							$('#messageemail').html('The email already exists. Please try login or choose another email.');
						}

					 }
				 });
        } else {
            $(thisObj).addClass('is-invalid');
			$('#defaultmessageemail').html('');
			$('#messageemail').html('Please enter a valid email address.');
        }
    }
	

    // Validate CheckBox
    function validateCheckBox(thisObj) {
         
        if($(':checkbox:checked').length > 0) {
            $(thisObj).addClass('is-valid');
        } else {
            $(thisObj).addClass('is-invalid');
        }
    }
	
	// Validate Phone Number
    function validatePhonenumber(thisObj) {
        let fieldValue = thisObj.val();
		// initialise plugin
    	if ($("#phone").attr("placeholder").length == fieldValue.length) {
            $(thisObj).addClass('is-valid');
        } else {
            $(thisObj).addClass('is-invalid');
        }
    }
	

})();
