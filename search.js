// DRA
var map = {};
map['African-American and African Studies'] = 51;
map['American Sign Language'] = 50;
map['American Studies'] = 52;
map['Anthropology'] = 1;
map['Applied Mathematics'] = 21;
map['Architecture'] = 39;
map['Art'] = 2;
map['Astronomy'] = 3;
map['Biology'] = 4;
map['Biomedical Engineering'] = 26;
map['Business (Darden School)'] = 41;
map['Chemical Engineering'] = 27;
map['Chemistry'] = 5;
map['Civil and Environmental Engineering'] = 29;
map['Classics'] = 6;
map['Cognitive Science'] = 53;
map['College Advising Seminars'] = 54;
map['Commerce (McIntire School)'] = 42;
map['Computer Science'] = 30;
map['Cross-Disciplinary Courses (ENGR)'] = 77;
map['Curriculum, Instruction, and Special Education'] = 74;
map['Drama'] = 7;
map['East Asian Languages, Literatures, and Cultures'] = 8;
map['East Asian Studies'] = 55;
map['Economics'] = 9;
map['Education Leadership, Foundations, and Policy'] = 74;
map['Electrical and Computer Engineering'] = 34;
map['English'] = 10;
map['Environmental Sciences'] = 11;
map['Environmental Thought and Practice'] = 56;
map['French Languages and Literatures'] = 12;
map['German Languages and Literatures'] = 13;
map['Global Studies'] = 58;
map['History'] = 14;
map['Human Services'] = 74;
map['Interdisciplinary Studies'] = 40;
map['Jewish Studies'] = 59;
map['Kinesiology'] = 74;
map['Latin American Studies'] = 60;
map['Law School'] = 45;
map['Liberal Arts Seminars'] = 62;
map['Linguistics'] = 63;
map['Materials Science and Engineering'] = 35;
map['Mathematics'] = 15;
map['Mechanical and Aerospace Engineering'] = 36;
map['Media Studies'] = 16;
map['Medical School'] = 46;
map['Medieval Studies'] = 64;
map['Middle Eastern and South Asian Languages and Cultures'] = 17;
map['Middle Eastern Studies'] = 65;
map['Music'] = 18;
map['Neuroscience'] = 66;
map['Nursing School'] = 47;
map['Pavillion Seminars'] = 69;
map['Philosophy'] = 19;
map['Physics'] = 20;
map['Political and Social Thought'] = 67;
map['Politics'] = 22;
map['Psychology'] = 24;
map['Public Health Sciences'] = 23;
map['Public Policy (Batten School)'] = 48;
map['Religious Studies'] = 25;
map['Science, Technology, and Society'] = 37;
map['Slavic Languages and Literatures'] = 28;
map['Sociology'] = 31;
map['South Asian Studies'] = 68;
map['Spanish, Italian, and Portuguese'] = 32;
map['Statistics'] = 33;
map['Systems and Information Engineering'] = 38;
map['University Seminars'] = 76;
map['Women, Gender, and Sexuality'] = 71;
function convertNumberToSemester(number) {
    var semester = "";
    var year = 0;
    if (number % 10 == 8) {
	semester = "Fall";
    }
    else if (number % 10 == 2) {
	semester = "Spring";
    }
    else if (number % 10 == 6) {
	semester = "Summer";
    }
    else if (number % 10 == 1) {
	semester = "January";
    }
    else {
	semester = "";
    }
    year = ((Math.floor(number / 1000) % 10) * 2000) + (Math.floor(number / 10) % 100);
    return ([semester, year]);
}
function convertSemesterToNumber(semester, year) {
    var number = 0;
    number = ((Math.floor(year / 1000) % 10) * 500) + ((year % 100) * 10);
    if (semester == "Fall") {
	number += 8;
    }
    else if (semester == "Spring") {
	number += 2;
    }
    else if (semester == "Summer") {
	number += 6;
    }
    else if (semester == "January") {
	number += 1;
    }
    else {
	number += 0;
    }
    return number;
}
function convertCourseToDepartment(course) {
    var department = map[course];
    return department;
}
$(function() {
    $("#searchClass").click(function(evt) {
	var semester = $("#semester option:selected").val();
	var year = Number($("#year").val());
	var S = semester;
	var Y = year;
	var subject = $("#subject option:selected").val();
	var inputCharactersNotPermitted = new RegExp("[<>]");
	if (semester != "Fall" && semester != "Spring" && semester != "Summer" && semester != "January") {
	    alert("Invalid Semester");
	}
	else if (year < 2000 || year > 2099 || inputCharactersNotPermitted.test(year)) {
	    alert("Invalid Year");
	}
	else {
	    var number = convertSemesterToNumber(semester, year);
	    var parent_node = document.getElementById("container");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#container").append(
		'<h2>Loading...</h2>'
	    );
	    var url = 'https://rabi.phys.virginia.edu/mySIS/CS2/page.php?Semester=' + number + '&Type=Group&Group=' + subject;
	    var encoded = encodeURIComponent(url);
	    $.getJSON('https://api.allorigins.ml/get?url=' + encoded + '&callback=?', function(data) {
		parent_node = document.getElementById("container");
		if (parent_node) {
		    while (parent_node.firstChild) {
			parent_node.removeChild(parent_node.firstChild);
		    }
		}
		var regex = data.contents.match(/(<tr><td class='UnitName' colspan='\d'>)[^<]*(<\/td><\/tr>)/gm);
		var subjectNames = [];
		var courseCodes = [];
		var courseTitles = [];
		var cc = [];
		var units = [];
		var enrollment = [];
		var professors = [];
		var times = [];
		var locations = [];
		if (regex != null) {
		    for (var i = 0; i < regex.length; i++) {
			if (regex[i].match(/>[^<]*</gm) != null && regex[i].match(/>[^<]*</gm).length > 1) {
			    if (regex[i].match(/>[^<]*</gm)[1].match(/[^><]*/gm) != null && regex[i].match(/>[^<]*</gm)[1].match(/[^><]*/gm).length > 1) {
				subjectNames.push(regex[i].match(/>[^<]*</gm)[1].match(/[^><]*/gm)[1]);
			    }
			    else {
				if (subjectNames.length == 0) {
				    subjectNames.push("");
				}
				else {
				    subjectNames.push(subjectNames[i - 1]);
				}
			    }
			}
			else {
			    if (subjectNames.length == 0) {
				subjectNames.push("");
			    }
			    else {
				subjectNames.push(subjectNames[i - 1]);
			    }
			}
		    }
		    regex = data.contents.match(/<span onmouseover="TCFOver\('[\d]*'\);" onmouseout="nd\(\);" onclick="TCF\('[\d]*'\);">[A-Za-z\s\d]*<\/span><\/td><td class='CourseName' colspan='[\d]*' onclick="ClassTip\('[A-Z]*','[\d]*'\);">[^>]*<\/td><\/tr>[^(<tr><td class='UnitName')]*/gm);
		    if (regex != null) {
			for (var i = 0; i < regex.length; i++) {
			    if (regex[i].match(/>[^<]*</gm) != null) {
				if (regex[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm) != null && regex[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm).length > 1) {
				    courseCodes.push(regex[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm)[1]);
				}
				else {
				    if (courseCodes.length == 0) {
					courseCodes.push("");
				    }
				    else {
					courseCodes.push(courseCodes[i - 1]);
				    }
				}
			    }
			    else {
				if (courseCodes.length == 0) {
				    courseCodes.push("");
				}
				else {
				    courseCodes.push(courseCodes[i - 1]);
				}
			    }
			    if (regex[i].match(/>[^<]*</gm) != null && regex[i].match(/>[^<]*</gm).length > 3) {
				if (regex[i].match(/>[^<]*</gm)[3].match(/[^><]*/gm) != null && regex[i].match(/>[^<]*</gm)[3].match(/[^><]*/gm).length > 1) {
				    courseTitles.push(regex[i].match(/>[^<]*</gm)[3].match(/[^><]*/gm)[1]);
				}
				else {
				    if (courseTitles.length == 0) {
					courseTitles.push("");
				    }
				    else {
					courseTitles.push(courseTitles[i - 1]);
				    }
				    
				}
			    }
			    else {
				if (courseTitles.length == 0) {
				    courseTitles.push("");
				}
				else {
				    courseTitles.push(courseTitles[i - 1]);
				}
			    }
			}
			regex = data.contents.match(/(<tr class='Section(Even|Odd).*<\/td><\/tr>|<tr class='Section(Even|Odd)[A-Z0-9\s]*'><td align='right'><a href='[^']*\n'.*<\/td><\/tr>)/gm);
			if (regex != null) {
			    for (var i = 0; i < regex.length; i++) {
				if (regex[i].match(/S [A-Z\d]*/gm) != null) {
				    if (regex[i].match(/S [A-Z\d]*/gm)[0].match(/[A-Z\d]*$/gm) != null) {
					cc.push(regex[i].match(/S [A-Z\d]*/gm)[0].match(/[A-Z\d]*$/gm)[0]);
				    }
				    else {
					if (cc.length == 0) {
					    cc.push("");
					}
					else {
					    cc.push(cc[i - 1]);
					}
				    }
				}
				else {
				    if (cc.length == 0) {
					cc.push("");
				    }
				    else {
					cc.push(cc[i - 1]);
				    }
				}
				if (regex[i].match(/([\d\s-]* Units)/gm) != null) {
				    if (regex[i].match(/([\d\s-]* Units)/gm)[0].match(/[\d\s-]*[\d]+/gm) != null) {
					units.push(regex[i].match(/([\d\s-]* Units)/gm)[0].match(/[\d\s-]*[\d]+/gm)[0]);
				    }
				    else {
					if (units.length == 0) {
					    units.push("");
					}
					else {
					    units.push(units[i - 1]);
					}
				    }
				}
				else {
				    if (units.length == 0) {
					units.push("");
				    }
				    else {
					units.push(units[i - 1]);
				    }
				}
				if (regex[i].match(/(Open|Closed|Wait[^<]*)/gm) != null) {
				    enrollment.push(regex[i].match(/(Open|Closed|Wait[^<]*)/gm)[0]);
				}
				else {
				    if (enrollment.length == 0) {
					enrollment.push("");
				    }
				    else {
					enrollment.push(enrollment[i - 1]);
				    }
				}
				if (regex[i].match(/;nd\(\);">[A-Za-z\s-.']*</gm) != null) {
				    if (regex[i].match(/;nd\(\);">[A-Za-z\s-.']*</gm)[0].match(/[^\(\);"<>]*/gm) != null && regex[i].match(/;nd\(\);">[A-Za-z\s-.']*</gm)[0].match(/[^\(\);"<>]*/gm).length > 8) {
					professors.push(regex[i].match(/;nd\(\);">[A-Za-z\s-.']*</gm)[0].match(/[^\(\);"<>]*/gm)[7]);
				    }
				    else {
					if (professors.length == 0) {
					    professors.push("");
					}
					else {
					    professors.push(professors[i - 1]);
					}
				    }
				}
				else {
				    if (professors.length == 0) {
					professors.push("");
				    }
				    else {
					professors.push(professors[i - 1]);
				    }
				}
				if (regex[i].match(/([A-Za-z\s"]* [\d]*:[\d]*[A-Z]* - [\d]*:[\d]*[A-Z]*|TBA["\s]*<\/td><td>)/gm) != null) {
				    if (regex[i].match(/([A-Za-z\s"]* [\d]*:[\d]*[A-Z]* - [\d]*:[\d]*[A-Z]*|TBA["\s]*<\/td><td>)/gm)[0].match(/[A-Z]+[^<>"]*/gm) != null) {
					times.push(regex[i].match(/([A-Za-z\s"]* [\d]*:[\d]*[A-Z]* - [\d]*:[\d]*[A-Z]*|TBA["\s]*<\/td><td>)/gm)[0].match(/[A-Z]+[^<>"]*/gm)[0]);
				    }
				    else {
					if (times.length == 0) {
					    times.push("");
					}
					else {
					    times.push(times[i - 1]);
					}
				    }
				}
				else {
				    if (times.length == 0) {
					times.push("");
				    }
				    else {
					times.push(times[i - 1]);
				    }
				}
				if (regex[i].match(/>([A-Za-z\s-&\(\)']+[\d\s]+<|(TBA|Contact Department|Desktop-Asynchronous|Office)<\/td><\/tr>|[A-Za-z-\s&\d\(\)'.]*(Web-|Center|Campus|Bldg|Library|Hall|House|Theatre|Drive|Auditorium|Room|Gymnasium|School|Home|Cmty Colleg|Field|Course|Pool|Hospital|UVA|Hill|Rec|Office|CHIP|Club|Elementary|Wall|Station)[A-Za-z-\s&\d\(\)'.]*)/gm) != null) {
				    if (regex[i].match(/>([A-Za-z\s-&\(\)']+[\d\s]+<|(TBA|Contact Department|Desktop-Asynchronous|Office)<\/td><\/tr>|[A-Za-z-\s&\d\(\)'.]*(Web-|Center|Campus|Bldg|Library|Hall|House|Theatre|Drive|Auditorium|Room|Gymnasium|School|Home|Cmty Colleg|Field|Course|Pool|Hospital|UVA|Hill|Rec|Office|CHIP|Club|Elementary|Wall|Station)[A-Za-z-\s&\d\(\)'.]*)/gm)[0].match(/[A-Z]+[^<>]*/gm) != null) {
					locations.push(regex[i].match(/>([A-Za-z\s-&\(\)']+[\d\s]+<|(TBA|Contact Department|Desktop-Asynchronous|Office)<\/td><\/tr>|[A-Za-z-\s&\d\(\)'.]*(Web-|Center|Campus|Bldg|Library|Hall|House|Theatre|Drive|Auditorium|Room|Gymnasium|School|Home|Cmty Colleg|Field|Course|Pool|Hospital|UVA|Hill|Rec|Office|CHIP|Club|Elementary|Wall|Station)[A-Za-z-\s&\d\(\)'.]*)/gm)[0].match(/[A-Z]+[^<>]*/gm)[0]);
				    }
				    else {
					if (locations.length == 0) {
					    locations.push("");
					}
					else {
					    locations.push(locations[i - 1]);
					}
				    }
				}
				else {
				    if (locations.length == 0) {
					locations.push("");
				    }
				    else {
					locations.push(locations[i - 1]);
				    }
				}
			    }
			}
		    }
		    var i = 0;
		    var iLength = subjectNames.length;
		    var j = 0;
		    var jLength = courseCodes.length;
		    var k = 0;
		    var kLength = cc.length;
		    while (i < iLength) {
			$("#container").append(
			    '<h2>' + subjectNames[i] + '</h2>'
			);
			var changedSubject = false;
			while (j < jLength && !changedSubject) {
			    $("#container").append(
				'<h3 id="' + cc[k] + 'hyperlinkh3"><a class="clickClass" title="' + subjectNames[i] + '_' + units[k] + '" id="' + cc[k] + 'hyperlink">' + courseCodes[j] + ': ' + courseTitles[j] + '</a></h3><table class="table"><thead><tr><th scope="col">Instructor</th><th scope="col">Time</th><th scope="col">Location</th><th scope="col">Enrollment</th><th scope="col">Credits</th></tr></thead><tbody id="' + cc[k] + '"></tbody></table>'
			    );
			    var changedCourse = false;
			    var theID = "#" + cc[k];
			    while (k < kLength && !changedCourse) {
				$(theID).append(
				    '<tr><td><a id="' + professors[k] + '" class="clickProf">' + professors[k] + '</a></td><td>' + times[k] + '</td><td>' + locations[k] + '</td><td>' + enrollment[k] + '</td><td>' + units[k] + '</td></tr>'
				);
				if (k + 1 < kLength && cc[k + 1] != cc[k]) {
				    changedCourse = true;
				}
				k++;
			    }
			    if (j + 1 < jLength && courseCodes[j + 1].match(/[A-Z]*/gm)[0] != courseCodes[j].match(/[A-Z]*/gm)[0]) {
				changedSubject = true;
			    }
			    j++;
			}
			i++;
		    }
		}
		else {
		    $("#container").append(
			'<h2>Semester not found</h2>'
		    );
		}
		$(".clickClass").click(function(evt) {
		    var cc = evt.target.id;
		    var titleData = evt.target.getAttribute('title');
		    var dept = titleData.match(/[^_]+/gm)[0];
		    var C = titleData.match(/[^_]+/gm)[1];
		    var course = cc.match(/[^\d]+/gm)[0];
		    var number = cc.match(/[^A-Za-z]+/gm)[0];
		    var department = convertCourseToDepartment(dept);
		    var noData = false;
		    var theID = "#" + cc + "h3";
		    if (document.getElementById("classDataTable")) {
			document.getElementById("classDataTable").remove();
		    }
		    if (document.getElementById("classDataBody")) {
			document.getElementById("classDataBody").remove();
		    }
		    if (document.getElementById("loading")) {
			document.getElementById("loading").remove();
		    }
		    if (document.getElementById("addClassButton")) {
			document.getElementById("addClassButton").remove();
		    }
		    if (document.getElementById("vagrades")) {
			document.getElementById("vagrades").remove();
		    }
		    $(theID).append(
			'<button type="submit" id="addClassButton"><strong>Add Class</strong></button><h4 id="loading">Loading...</h4><iframe id="vagrades" src="https://vagrades.com/uva/' + course + number + '"></iframe>'
		    );
		    $("#addClassButton").click(function(evt2) {
			evt2.preventDefault();
			var addClass = $.ajax({
			    type: "POST",
			    url: "controller.php?request=addClass",
			    data: {semester: S, year: Y, title: course + " " + number, credits: C, grade: ""},
			    dataType: "text"
			});
			addClass.done(function(data) {
			    if (data == "pass") {
				alert("Class added successfully");
			    }
			    else {
				alert("This is a duplicate class");
			    }
			    if (document.getElementById("addClassButton")) {
				document.getElementById("addClassButton").remove();
			    }
			});
		    });
		    if (department == undefined) {
			noData = true;
			if (document.getElementById("loading")) {
			    document.getElementById("loading").remove();
			}
			//alert("No data found for class " + course + " " + number);
		    }
		    else {
			var fetchClassInfo = $.ajax({
			    type: "POST",
			    url: "controller.php?request=fetchClassInfo",
			    data: {department: department, course: course, number: number},
			    dataType: "text"
			});
			fetchClassInfo.done(function(data) {
			    if (data == "") {
				noData = true;
			    }
			    var professors = [];
			    var ratings = [];
			    var difficulties = [];
			    var gpas = [];
			    var match0 = data.match(/<div class="row prof-title">[^<>]*<\/div>/gm);
			    if (match0 != null) {
				for (var i = 0; i < match0.length; i++) {
				    var p = match0[i].match(/[^<>]+/gm);
				    if (p != null && p.length > 1) {
					professors.push(p[1]);
				    }
				    else {
					professors.push("");
				    }
				}
			    }
			    else {
				noData = true;
			    }
			    var match1 = data.match(/<h4 class="[a-z-]*">[\d\.-]*<\/h4>/gm);
			    if (match1 != null) {
				for (var i = 0; i < match1.length; i++) {
				    var match2 = match1[i].match(/([\d]+\.[\d]+|--)/gm);
				    if (match2 != null) {
					if (i % 3 == 0) {
					    ratings.push(match2[0]);
					}
					else if (i % 3 == 1) {
					    difficulties.push(match2[0]);
					}
					else {
					    gpas.push(match2[0]);
					}
				    }
				    else {
					ratings.push("");
					difficulties.push("");
					gpas.push("");
				    }
				}
			    }
			    else {
				noData = true;
			    }
			    if (noData) {
				if (document.getElementById("loading")) {
				    document.getElementById("loading").remove();
				}
				//alert("No data found for class " + course + " " + number);
			    }
			    else {
				if (document.getElementById("loading")) {
				    document.getElementById("loading").remove();
				}
				$(theID).append(
				    '<table id="classDataTable" class="table"><thead><tr><th scope="col">Instructor</th><th scope="col">Rating</th><th scope="col">Difficulty</th><th scope="col">GPA</th></thead><tbody id="classDataBody"></tbody></table>'
				);
				for (var i = 0; i < professors.length; i++) {
				    $("#classDataBody").append(
					'<tr><td><a id="' + professors[i] + '" class="clickProf">' + professors[i] + '</a></td><td>' + ratings[i] + '</td><td>' + difficulties[i] + '</td><td>' + gpas[i] + '</td></tr>'
				    );
				}
				$(".clickProf").click(function(evt) {
				    var professor = evt.target.id;
				    if (professor.length == 0) {
					alert("Invalid Name");
				    }
				    else {
					var parent_node = document.getElementById("container");
					if (parent_node) {
					    while (parent_node.firstChild) {
						parent_node.removeChild(parent_node.firstChild);
					    }
					}
					$("#container").append(
					    '<h2>Loading...</h2>'
					);
					var fetchProfessorInfo = $.ajax({
					    type: "POST",
					    url: "controller.php?request=fetchProfessorInfo",
					    data: {professor: professor},
					    dataType: "json"
					});
					fetchProfessorInfo.done(function(data) {
					    parent_node = document.getElementById("container");
					    if (parent_node) {
						while (parent_node.firstChild) {
						    parent_node.removeChild(parent_node.firstChild);
						}
					    }
					    if (data == "" || data.length == 0 || data["classes"].length == 0) {
						alert("No data found for professor " + professor);
						window.location = 'search.php';
					    }
					    else {
						$("#container").append(
						    '<h2>' + professor + '</h2><table id="professorDataTable" class="table"><thead><tr><th scope="col">Class</th><th scope="col">Rating</th><th scope="col">Difficulty</th><th scope="col">GPA</th></thead><tbody id="professorDataBody"></tbody></table>'
						);
						for (var i = 0; i < data["classes"].length; i++) {
						    $("#professorDataBody").append(
							'<tr><td>' + data["classes"][i] + '</td><td>' + data["ratings"][i] + '</td><td>' + data["difficulties"][i] + '</td><td>' + data["gpas"][i] + '</td></tr>'
						    );
						}
					    }
					});
				    }
				});
			    }
			});
		    }
		});
		$(".clickProf").click(function(evt) {
		    var professor = evt.target.id;
		    if (professor.length == 0) {
			alert("Invalid Name");
		    }
		    else {
			var parent_node = document.getElementById("container");
			if (parent_node) {
			    while (parent_node.firstChild) {
				parent_node.removeChild(parent_node.firstChild);
			    }
			}
			$("#container").append(
			    '<h2>Loading...</h2>'
			);
			var fetchProfessorInfo = $.ajax({
			    type: "POST",
			    url: "controller.php?request=fetchProfessorInfo",
			    data: {professor: professor},
			    dataType: "json"
			});
			fetchProfessorInfo.done(function(data) {
			    parent_node = document.getElementById("container");
			    if (parent_node) {
				while (parent_node.firstChild) {
				    parent_node.removeChild(parent_node.firstChild);
				}
			    }
			    if (data == "" || data.length == 0 || data["classes"].length == 0) {
				alert("No data found for professor " + professor);
				window.location = 'search.php';
			    }
			    else {
				$("#container").append(
				    '<h2>' + professor + '</h2><table id="professorDataTable" class="table"><thead><tr><th scope="col">Class</th><th scope="col">Rating</th><th scope="col">Difficulty</th><th scope="col">GPA</th></thead><tbody id="professorDataBody"></tbody></table>'
				);
				for (var i = 0; i < data["classes"].length; i++) {
				    $("#professorDataBody").append(
					'<tr><td>' + data["classes"][i] + '</td><td>' + data["ratings"][i] + '</td><td>' + data["difficulties"][i] + '</td><td>' + data["gpas"][i] + '</td></tr>'
				    );
				}
			    }
			});
		    }
		});
	    });
	}
    });
    $("#searchProfessor").click(function(evt) {
	var professor = $("#name").val();
	var inputCharactersNotPermitted = new RegExp("[<>]");
	if (professor.length == 0 || inputCharactersNotPermitted.test(professor)) {
	    alert("Invalid Name");
	}
	else {
	    var parent_node = document.getElementById("container");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    $("#container").append(
		'<h2>Loading...</h2>'
	    );
	    var fetchProfessorInfo = $.ajax({
		type: "POST",
		url: "controller.php?request=fetchProfessorInfo",
		data: {professor: professor},
		dataType: "json"
	    });
	    fetchProfessorInfo.done(function(data) {
		parent_node = document.getElementById("container");
		if (parent_node) {
		    while (parent_node.firstChild) {
			parent_node.removeChild(parent_node.firstChild);
		    }
		}
		if (data == "" || data.length == 0 || data["classes"].length == 0) {
		    alert("No data found for professor " + professor);
		    window.location = 'search.php';
		}
		else {
		    $("#container").append(
			'<h2>' + professor + '</h2><table id="professorDataTable" class="table"><thead><tr><th scope="col">Class</th><th scope="col">Rating</th><th scope="col">Difficulty</th><th scope="col">GPA</th></thead><tbody id="professorDataBody"></tbody></table>'
		    );
		    for (var i = 0; i < data["classes"].length; i++) {
			$("#professorDataBody").append(
			    '<tr><td>' + data["classes"][i] + '</td><td>' + data["ratings"][i] + '</td><td>' + data["difficulties"][i] + '</td><td>' + data["gpas"][i] + '</td></tr>'
			);
		    }
		}
	    });
	}
    });
});
