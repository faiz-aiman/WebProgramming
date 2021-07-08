populateCountries("country", "state"); 

tinymce.init({
	selector:'#desc',
	menubar: false,
	min_height: 300,
	max_height: 300
});

$(".datepicker").datepicker({
	dateFormat: "dd/mm/yy",
	changeMonth: true,
	changeYear: true,
	minDate: 1
});
$('.timepicker').timepicker({});

$("#jobtitle").bind("keyup focusin", function(){
	var maxkey = $(this).attr("maxlength");
	var length = $(this).val().length;
	var value = $(this).val();
	$(this).parent().find("#counter").text(length+"/"+maxkey+" characters only");
	if (length > maxkey) $(this).val(value.substring(0, maxkey));
}).bind("focusout", function(){$(this).parent().find("#counter").text("")});

function clearButton() {
	let btnClear = document.getElementById("clear");
	let inputs = document.querySelectorAll("input");
	let textarea = document.querySelectorAll("textarea");
	document.getElementById("preview").src = "../images/default-job-photo.png";
	var my_editor_id = 'desc';
	// set the content empty
	tinymce.get(my_editor_id).setContent(''); 
	inputs.forEach((input) => {
		input.value = "";
	});
}


function getIp(callback) {
	fetch("https://ipinfo.io/json?token=307e862f458995", { headers: { Accept: "application/json" } })
		.then((resp) => resp.json())
		.catch(() => {
			return {
				country: "my",
			};
		})
		.then((resp) => callback(resp.country));
}
const phoneInputField = document.querySelector("#phone");
const phoneInput = window.intlTelInput(phoneInputField, {
	preferredCountries: ["my", "us", "gb", "cn"],
	initialCountry: "auto",
	//hiddenInput: "full_phone",
	geoIpLookup: getIp,
	utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
}); 
$('#phone').on('focus', function(){
	var $this = $(this),
	// Get active country's phone number format from input placeholder attribute
	activePlaceholder = $this.attr('placeholder'),
	// Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
	newMask = activePlaceholder.replace(/[1-9]/g, "0");
	// console.log(activePlaceholder + ' => ' + newMask);

	// Init new mask for focused input
	$this.mask(newMask);
	var countryCode = $('.iti__selected-flag').attr('title');
	var countryCode = countryCode.replace(/[^0-9]/g,'')
	document.getElementById("countryphone").value=countryCode;
}); 

$('#currency').maskMoney();