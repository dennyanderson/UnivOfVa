// DRA
$(function() {
    var fetchData = $.ajax({
	type: "POST",
	url: "controller.php?request=fetchData",
	dataType: "json"
    });
    fetchData.done(function(data) {
	var id = data[0]["computing_id"];
	var first = data[0]["first_name"];
	var last = data[0]["last_name"];
	var career = data[0]["career"];
	var program = data[0]["academic_program"];
	var area1 = data[0]["area_of_study_1"];
	var area2 = data[0]["area_of_study_2"];
	$("#computing-id").val(id);
	$("#first").val(first);
	$("#last").val(last);
	$("#career").val(career);
	var career = $("#career option:selected").val();
	var parent_node = document.getElementById("program");
	if (parent_node) {
	    while (parent_node.firstChild) {
		parent_node.removeChild(parent_node.firstChild);
	    }
	}
	if (career == "Graduate") {
	    parent_node = document.getElementById("pu");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#program").append(
		'<option id="pu" value="Undecided" selected="selected">Undecided</option>' +
		'<option value="Architecture Graduate">Architecture Graduate</option>' +
		'<option value="Arts & Sciences Graduate">Arts & Sciences Graduate</option>' +
		'<option value="Commerce Graduate">Commerce Graduate</option>' +
		'<option value="Education Graduate">Education Graduate</option>' +
		'<option value="Engineering Graduate">Engineering Graduate</option>' +
		'<option value="Ldsh & Public Policy Grad">Ldsh & Public Policy Grad</option>' +
		'<option value="Medicine Graduate">Medicine Graduate</option>' +
		'<option value="Medicine Graduate Non-Degree">Medicine Graduate Non-Degree</option>' +
		'<option value="Nursing Graduate">Nursing Graduate</option>' +
		'<option value="Provost Graduate">Provost Graduate</option>' +
		'<option value="SCPS Graduate">SCPS Graduate</option>'    
	    );
	}
	else if (career == "Law") {
	    parent_node = document.getElementById("pu");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#program").append(
		'<option id="pu" value="Undecided" selected="selected">Undecided</option>' +
		'<option value="Law">Law</option>'
	    );
	}
	else if (career == "Undergraduate") {
	    parent_node = document.getElementById("pu");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#program").append(
		'<option id="pu" value="Undecided" selected="selected">Undecided</option>' +
		'<option value="Architecture Undergraduate">Architecture Undergraduate</option>' +
		'<option value="Arts & Sciences Undergraduate">Arts & Sciences Undergraduate</option>' +
		'<option value="Commerce Undergraduate">Commerce Undergraduate</option>' +
		'<option value="Education Undergraduate">Education Undergraduate</option>' +
		'<option value="Engineering Undergraduate">Engineering Undergraduate</option>' +
		'<option value="Ldsh & Public Policy Undergrad">Ldsh & Public Policy Undergrad</option>' +
		'<option value="Nursing Undergraduate">Nursing Undergraduate</option>' +
		'<option value="SCPS Undergraduate">SCPS Undergraduate</option>' +
		'<option value="Visiting Undergrad Non-Degree">Visiting Undergrad Non-Degree</option>'
	    );
	}
	else {
	    parent_node = document.getElementById("pu");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#program").append(
		'<option id="pu" value="Undecided" selected="selected">Undecided</option>'
	    );
	}
	$("#program").val(program);
	$("#area1").val(area1);
	$("#area2").val(area2);
    });
    $("#career").change(function(evt) {
	var career = $("#career option:selected").val();
	var parent_node = document.getElementById("program");
	if (parent_node) {
	    while (parent_node.firstChild) {
		parent_node.removeChild(parent_node.firstChild);
	    }
	}
	if (career == "Graduate") {
	    parent_node = document.getElementById("pu");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#program").append(
		'<option id="pu" value="Undecided" selected="selected">Undecided</option>' +
		'<option value="Architecture Graduate">Architecture Graduate</option>' +
		'<option value="Arts & Sciences Graduate">Arts & Sciences Graduate</option>' +
		'<option value="Commerce Graduate">Commerce Graduate</option>' +
		'<option value="Education Graduate">Education Graduate</option>' +
		'<option value="Engineering Graduate">Engineering Graduate</option>' +
		'<option value="Ldsh & Public Policy Grad">Ldsh & Public Policy Grad</option>' +
		'<option value="Medicine Graduate">Medicine Graduate</option>' +
		'<option value="Medicine Graduate Non-Degree">Medicine Graduate Non-Degree</option>' +
		'<option value="Nursing Graduate">Nursing Graduate</option>' +
		'<option value="Provost Graduate">Provost Graduate</option>' +
		'<option value="SCPS Graduate">SCPS Graduate</option>'    
	    );
	}
	else if (career == "Law") {
	    parent_node = document.getElementById("pu");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#program").append(
		'<option id="pu" value="Undecided" selected="selected">Undecided</option>' +
		'<option value="Law">Law</option>'
	    );
	}
	else if (career == "Undergraduate") {
	    parent_node = document.getElementById("pu");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#program").append(
		'<option id="pu" value="Undecided" selected="selected">Undecided</option>' +
		'<option value="Architecture Undergraduate">Architecture Undergraduate</option>' +
		'<option value="Arts & Sciences Undergraduate">Arts & Sciences Undergraduate</option>' +
		'<option value="Commerce Undergraduate">Commerce Undergraduate</option>' +
		'<option value="Education Undergraduate">Education Undergraduate</option>' +
		'<option value="Engineering Undergraduate">Engineering Undergraduate</option>' +
		'<option value="Ldsh & Public Policy Undergrad">Ldsh & Public Policy Undergrad</option>' +
		'<option value="Nursing Undergraduate">Nursing Undergraduate</option>' +
		'<option value="SCPS Undergraduate">SCPS Undergraduate</option>' +
		'<option value="Visiting Undergrad Non-Degree">Visiting Undergrad Non-Degree</option>'
	    );
	}
	else {
	    parent_node = document.getElementById("pu");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#program").append(
		'<option id="pu" value="Undecided" selected="selected">Undecided</option>'
	    );
	}
    });
    $("#click").click(function(evt) {
	evt.preventDefault();
	var password = $("#password").val();
	var career = $("#career").val();
	var program = $("#program").val();
	var area1 = $("#area1").val();
	var area2 = $("#area2").val();
	var changedPassword = password.length != 0;
	var passwordRequirements = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
	var inputCharactersNotPermitted = new RegExp("[<>]");
	if (changedPassword && (password.length < 8 || password.length > 128 || !passwordRequirements.test(password))) {
	    alert("Password must contain at least 1 lowercase letter, 1 uppercase letter, 1 number, 1 special character ('!', '@', '#', '$', '%', '^', '&', '*'), and be at least 8 characters");
	}
	else if (career.length < 1 || career.length > 13 || inputCharactersNotPermitted.test(career)) {
	    alert("Invalid Career");
	}
	else if (program.length < 1 || program.length > 30 || inputCharactersNotPermitted.test(program)) {
	    alert("Invalid Academic Program");
	}
	else if (area1.length < 1 || area1.length > 53 || area2.length < 1 || area2.length > 53 || inputCharactersNotPermitted.test(area1) || inputCharactersNotPermitted.test(area2)) {
	    alert("Invalid Area of Study");
	}
	else {
	    var editData = $.ajax({
		type: "POST",
		url: "controller.php?request=editData",
		data: {password: password, career: career, program: program, area1: area1, area2: area2},
		dataType: "text"
	    });
	    editData.done(function(data) {
		if (data != "error") {
		    alert("Account updated successfully");
		    window.location = 'index.php';
		}
		else {
		    alert("We have detected that you are attempting to perform a JavaScript or SQL injection, which is against the site's terms of use policy. We have temporarily disabled your account while it is being reviewed.");
		    window.location = 'index.php';
		}
	    });
	}
    });
});
