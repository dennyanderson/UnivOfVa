// DRA
function convertGradeToGPA(letter) {
    if (letter == "A+") {
	return 4.0;
    }
    else if (letter == "A") {
	return 4.0;
    }
    else if (letter == "A-") {
	return 3.7;
    }
    else if (letter == "B+") {
	return 3.3;
    }
    else if (letter == "B") {
	return 3.0;
    }
    else if (letter == "B-") {
	return 2.7;
    }
    else if (letter == "C+") {
	return 2.3;
    }
    else if (letter == "C") {
	return 2.0;
    }
    else if (letter == "C-") {
	return 1.7;
    }
    else if (letter == "D+") {
	return 1.3;
    }
    else if (letter == "D") {
	return 1.0;
    }
    else if (letter == "D-") {
	return 0.7;
    }
    else if (letter == "F") {
	return 0.0;
    }
    else {
	return -1.0;
    }
}
function round(value, decimals) {
    return (Number(Math.round(value + 'e' + decimals) + 'e-' + decimals));
}
$(function() {
    var fetchClasses = $.ajax({
	type: "POST",
	url: "controller.php?request=fetchClasses",
	dataType: "json"
    });
    fetchClasses.done(function(data) {
	var totalCredits = 0;
	var totalPoints = 0.0;
	var totalCreditsOverall = 0;
	for (var i = 0; i < data.length; i++) {
	    var semester = data[i]['semester'];
	    var year = data[i]['year'];
	    var title = data[i]['title'];
	    var credits = data[i]['credits'];
	    var grade = data[i]['grade'];
	    $("#tbody").append(
		'<tr><td>' + semester + '</td><td>' + year + '</td><td>' + title + '</td><td>' + credits + '</td><td>' + grade + '</td></tr>'
	    );
	    var points = convertGradeToGPA(grade);
	    if (grade != "" && grade != "W" && grade != "IN") {
		totalCreditsOverall += credits;
	    }
	    if (points >= 0) {
		totalCredits += credits;
		totalPoints += (credits * points);
	    }
	}
	var gpa = round(totalPoints / totalCredits, 3);
	if (isNaN(gpa)) {
	    gpa = 0;
	}
	$("#container").append(
	    '<table id="totals" class="table"><thead><tr><th scope="col">Credit Total</th><th>Cumulative GPA</th></tr></thead><tbody><tr><td>' + totalCreditsOverall + '</td><td>' + gpa + '</td></tr></tbody></table>'
	);
	$("#add").click(function(evt) {
	    evt.preventDefault();
	    var parent_node = document.getElementById("tbody");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    parent_node = document.getElementById("totals");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    parent_node = document.getElementById("buttons");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#tbody").append(
		'<tr><td><select id="semester"><option value="Fall" selected="selected">Fall</option><option value="Spring">Spring</option><option value="Summer">Summer</option><option value="January">January</option></select></td><td><input id="year" type="number" min="0" max="32767" required></input></td><td><input id="title" type="text" required maxlength="30"></input></td><td><input id="credits" type="number" min="0" max="255" required></input></td><td><select id="grade"><option value="" selected="selected"></option><option value="A+">A+</option><option value="A">A</option><option value="A-">A-</option><option value="B+">B+</option><option value="B">B</option><option value="B-">B-</option><option value="C+">C+</option><option value="C">C</option><option value="C-">C-</option><option value="D+">D+</option><option value="D">D</option><option value="D-">D-</option><option value="P">P</option><option value="F">F</option><option value="S">S</option><option value="U">U</option><option value="W">W</option><option value="IN">IN</option></select></td></tr>'
	    );
	    $("#container").append(
		'<button type="submit" id="addClass"><strong>Add Class</strong></button>'
	    );
	    $("#addClass").click(function(evt) {
		evt.preventDefault();
		var semester = $("#semester").val();
		var year = Number($("#year").val());
		var title = $("#title").val();
		var credits = Number($("#credits").val());
		var grade = $("#grade").val();
		var titleRequirements = new RegExp("^(?=.*[\"])");
		var inputCharactersNotPermitted = new RegExp("[<>]");
		if (semester != "Fall" && semester != "Spring" && semester != "Summer" && semester != "January") {
		    alert("Invalid Semester");
		}
		else if (year == "" || year < 0 || year > 32767 || inputCharactersNotPermitted.test(year)) {
		    alert("Invalid Year");
		}
		else if (title.length < 1 || title.length > 30 || titleRequirements.test(title) || inputCharactersNotPermitted.test(title)) {
		    alert("Invalid Title");
		}
		else if (credits == "" || credits < 0 || credits > 255 || inputCharactersNotPermitted.test(credits)) {
		    alert("Invalid Credits");
		}
		else if (grade.length > 2 || inputCharactersNotPermitted.test(grade)) {
		    alert("Invalid Grade");
		}
		else {
		    var addClass = $.ajax({
			type: "POST",
			url: "controller.php?request=addClass",
			data: {semester: semester, year: year, title: title, credits: credits, grade: grade},
			dataType: "text"
		    });
		    addClass.done(function(data) {
			if (data != "error") {
			    if (data == "pass") {
				alert("Class added successfully");
				window.location = 'classes.php';
			    }
			    else {
				alert("This is a duplicate class");
			    }
			}
			else {
			    alert("We have detected that you are attempting to perform a JavaScript or SQL injection, which is against the site's terms of use policy. We have temporarily disabled your account while it is being reviewed.");
			    window.location = 'index.php';
			}
		    });
		}
	    });
	});
	$("#edit").click(function(evt) {
	    evt.preventDefault();
	    parent_node = document.getElementById("tbody");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    parent_node = document.getElementById("totals");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    parent_node = document.getElementById("buttons");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#header-row").append(
		'<th scope="col">Edit Class</th>'
            );
	    for (var i = 0; i < data.length; i++) {
		var semester = data[i]['semester'];
		var year = data[i]['year'];
		var title = data[i]['title'];
		var credits = data[i]['credits'];
		var grade = data[i]['grade'];
		$("#tbody").append(
		    '<tr><td>' + semester + '</td><td>' + year + '</td><td>' + title + '</td><td>' + credits + '</td><td>' + grade + '</td><td><a class="editClass" id="' + semester + '_' + year + '_' + title + '_' + credits + '_' + grade + '">Edit</a></td></tr>'
		);
	    }
	    $(".editClass").click(function(evt) {
		evt.preventDefault();
		var semester_year_title = evt.target.id;
		var semester = "";
		var year = "";
		var title = "";
		var credits = "";
		var grade = "";
		var numUnderscore = 0;
		for (var i = 0; i < semester_year_title.length; i++) {
		    if (semester_year_title[i] == "_") {
			numUnderscore++;
		    }
		    else if (numUnderscore == 0) {
			semester += semester_year_title[i];
		    }
		    else if (numUnderscore == 1) {
			year += semester_year_title[i];
		    }
		    else if (numUnderscore == 2) {
			title += semester_year_title[i];
		    }
		    else if (numUnderscore == 3) {
			credits += semester_year_title[i];
		    }
		    else {
			grade += semester_year_title[i];
		    }
		}
		parent_node = document.getElementById("tbody");
		if (parent_node) {
		    while (parent_node.firstChild) {
			parent_node.removeChild(parent_node.firstChild);
		    }
		}
		parent_node = document.getElementById("header-row");
		if (parent_node) {
		    while (parent_node.firstChild) {
			parent_node.removeChild(parent_node.firstChild);
		    }
		}
		$("#header-row").append(
		    '<th scope="col">Semester</th><th scope="col">Year</th><th scope="col">Title</th><th scope="col">Credits</th><th scope="col">Grade</th>'
		);
		$("#tbody").append(
		    '<tr><td><select id="semester"><option value="Fall" selected="selected">Fall</option><option value="Spring">Spring</option><option value="Summer">Summer</option><option value="January">January</option></select></td><td><input id="year" type="number" min="0" max="32767" required></input></td><td><input id="title" type="text" required maxlength="30"></input></td><td><input id="credits" type="number" min="0" max="255" required></input></td><td><select id="grade"><option value="" selected="selected"></option><option value="A+">A+</option><option value="A">A</option><option value="A-">A-</option><option value="B+">B+</option><option value="B">B</option><option value="B-">B-</option><option value="C+">C+</option><option value="C">C</option><option value="C-">C-</option><option value="D+">D+</option><option value="D">D</option><option value="D-">D-</option><option value="P">P</option><option value="F">F</option><option value="S">S</option><option value="U">U</option><option value="W">W</option><option value="IN">IN</option></select></td></tr>'
		);
		$("#semester").val(semester);
		$("#year").val(year);
		$("#title").val(title);
		$("#credits").val(Number(credits));
		$("#grade").val(grade);
		$("#container").append(
		    '<button type="submit" id="editClass"><strong>Edit Class</strong></button>'
		);
		$("#editClass").click(function(evt) {
		    evt.preventDefault();
		    var newSemester = $("#semester").val();
		    var newYear = Number($("#year").val());
		    var newTitle = $("#title").val();
		    var newCredits = Number($("#credits").val());
		    var newGrade = $("#grade").val();
		    var titleRequirements = new RegExp("^(?=.*[\"])");
		    var inputCharactersNotPermitted = new RegExp("[<>]");
		    if (newSemester != "Fall" && newSemester != "Spring" && newSemester != "Summer" && newSemester != "January") {
			alert("Invalid Semester");
		    }
		    else if (newYear == "" || newYear < 0 || newYear > 32767 || inputCharactersNotPermitted.test(newYear)) {
			alert("Invalid Year");
		    }
		    else if (newTitle.length < 1 || newTitle.length > 30 || titleRequirements.test(newTitle) || inputCharactersNotPermitted.test(newTitle)) {
			alert("Invalid Title");
		    }
		    else if (newCredits == "" || newCredits < 0 || newCredits > 255 || inputCharactersNotPermitted.test(newCredits)) {
			alert("Invalid Credits");
		    }
		    else if (newGrade.length > 2 || inputCharactersNotPermitted.test(newGrade)) {
			alert("Invalid Grade");
		    }
		    else {
			var editClass = $.ajax({
			    type: "POST",
			    url: "controller.php?request=editClass",
			    data: {semester: semester, year: year, title: title, newSemester: newSemester, newYear: newYear, newTitle: newTitle, newCredits: newCredits, newGrade: newGrade},
			    dataType: "text"
			});
			editClass.done(function(data) {
			    if (data != "error") {
				if (data == "pass") {
				    alert("Class edited successfully");
				    window.location = 'classes.php';
				}
				else {
				    alert("This is a duplicate class");
				}
			    }
			    else {
				alert("We have detected that you are attempting to perform a JavaScript or SQL injection, which is against the site's terms of use policy. We have temporarily disabled your account while it is being reviewed.");
				window.location = 'index.php';
			    }
			});
		    }
		});
	    });
	});
	$("#remove").click(function(evt) {
	    evt.preventDefault();
	    parent_node = document.getElementById("tbody");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    parent_node = document.getElementById("totals");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    parent_node = document.getElementById("buttons");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#header-row").append(
		'<th scope="col">Remove Class</th>'
            );
	    for (var i = 0; i < data.length; i++) {
		var semester = data[i]['semester'];
		var year = data[i]['year'];
		var title = data[i]['title'];
		var credits = data[i]['credits'];
		var grade = data[i]['grade'];
		$("#tbody").append(
		    '<tr><td>' + semester + '</td><td>' + year + '</td><td>' + title + '</td><td>' + credits + '</td><td>' + grade + '</td><td><a class="removeClass" id="' + semester + '_' + year + '_' + title + '">Remove</a></td></tr>'
		);
	    }
	    $(".removeClass").click(function(evt) {
		evt.preventDefault();
		var semester_year_title = evt.target.id;
		var semester = "";
		var year = "";
		var title = "";
		var numUnderscore = 0;
		for (var i = 0; i < semester_year_title.length; i++) {
		    if (semester_year_title[i] == "_") {
			numUnderscore++;
		    }
		    else if (numUnderscore == 0) {
			semester += semester_year_title[i];
		    }
		    else if (numUnderscore == 1) {
			year += semester_year_title[i];
		    }
		    else {
			title += semester_year_title[i];
		    }
		}
		var removeClass = $.ajax({
		    type: "POST",
		    url: "controller.php?request=removeClass",
		    data: {semester: semester, year: year, title: title},
		    dataType: "text"
		});
		removeClass.done(function(data) {
		    alert("Class removed successfully");
		    window.location = 'classes.php';
		});
	    });
	});
    });
});
