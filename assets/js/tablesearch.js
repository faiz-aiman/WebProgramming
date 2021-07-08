// FOR TABLE SEARCH
			
function search() {
	
  var input, filter, table, tr, td, i, txtValue, result;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");
  result = 0;
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
		result++;
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
	var n = document.getElementById("noresultstable");
	  if (result == 0 && n) {
		n.style.display = "";
		table.getElementsByTagName("tbody").style="none";
	  } else {
		n.style.display = "none";
		table.getElementsByTagName("tbody").style="";
	  }
}

function searchjob() {
	
  var input, filter, table, tr, td, i, txtValue, result;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");
  result = 0;
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
		result++;
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
	
	var n = document.getElementById("noresultstable");
	  if (result == 0 && n) {
		n.style.display = "";
		table.getElementsByTagName("tbody").style="none";
	  } else {
		n.style.display = "none";
		table.getElementsByTagName("tbody").style="";
	  }
}

function searchevent() {
	
  var input, filter, table, tr, td, i, txtValue, result;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");
  result = 0;
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
		  result++;
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
	var n = document.getElementById("noresultstable");
	  if (result == 0 && n) {
		n.style.display = "";
		table.getElementsByTagName("tbody").style="none";
	  } else {
		n.style.display = "none";
		table.getElementsByTagName("tbody").style="";
	  }
}
	
  function searchAlumni() {
    // Declare variables
    var input, filter, profileList, profile, searchFilter, i, txtName, txtDepartment, result;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    profileList = document.getElementById("profile-list");
    profile = profileList.getElementsByClassName('profile-card');
	result = 0;

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < profile.length; i++) {
        alumniName = profile[i].getElementsByClassName("alumni-name")[0];
        alumniDepartment = profile[i].getElementsByClassName("alumni-department")[0];
        txtName = alumniName.textContent || alumniName.innerText;
        txtDepartment = alumniDepartment.textContent || alumniDepartment.innerText;
        if (txtName.toUpperCase().indexOf(filter) > -1 || txtDepartment.toUpperCase().indexOf(filter) > -1) {
            profile[i].style.display = "";
			result++;
        } else {
            profile[i].style.display = "none";
        }
		
    }
	  
	  var n = document.getElementById("noresults");
	  if ( result == 0) {
		n.style.display = "";
		profileList.style.display = "none";
		document.getElementById("searchitem").innerHTML = input.value;
	  } else {
		profileList.style.display = "";
		n.style.display = "none";
	  }
}

function searchJob1() {
    // Declare variables
    var input, filter, profileList, profile, searchFilter, i, txtName, txtDepartment, result;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    profileList = document.getElementById("profile-list");
    profile = profileList.getElementsByClassName('profile-card');
	result = 0;

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < profile.length; i++) {
        alumniName = profile[i].getElementsByClassName("alumni-name")[0];
        alumniDepartment = profile[i].getElementsByClassName("alumni-department")[0];
        jobType = profile[i].getElementsByClassName("job-type")[0];
        jobLocation = profile[i].getElementsByClassName("job-location")[0];
        txtName = alumniName.textContent || alumniName.innerText;
        txtDepartment = alumniDepartment.textContent || alumniDepartment.innerText;
        //additional to search job type and location
        txtJobType = jobType.textContent || jobType.innerText; 
        txtJobLocation = jobLocation.textContent || jobType.innerText;
        if (txtName.toUpperCase().indexOf(filter) > -1 || txtDepartment.toUpperCase().indexOf(filter) > -1 
            || txtJobType.toUpperCase().indexOf(filter)>-1 || txtJobLocation.toUpperCase().indexOf(filter)>-1) {
            profile[i].style.display = "";
			result++;
        } else {
            profile[i].style.display = "none";
        }
    }
	
	var n = document.getElementById("noresults");
	  if (result == 0) {
		n.style.display = "";
		profileList.style.display = "none";
		document.getElementById("searchitem").innerHTML = input.value;
	  } else {
		profileList.style.display = "";
		n.style.display = "none";
	  }
}