// DRA
var map = {};
map['African-American and African Studies'] = 'AAS';
map['American Sign Language'] = 'ASL';
map['American Studies'] = 'AMST';
map['Anthropology'] = 'Anthropology';
map['Applied Mathematics'] = 'APMA';
map['Archaeology'] = 'Archaeology';
map['Architecture'] = 'SARC';
map['Art'] = 'Art';
map['Astronomy'] = 'Astronomy';
map['Bachelor of Interdisciplinary Studies'] = 'BIS';
map['Biology'] = 'Biology';
map['Biomedical Engineering'] = 'BME';
map['Business (Darden School)'] = 'DARD';
map['Chemical Engineering'] = 'CHE';
map['Chemistry'] = 'Chemistry';
map['Civic and Community Engagement'] = 'CivicCommunityEngagement';
map['Civil and Environmental Engineering'] = 'CEE';
map['Classics'] = 'Classics';
map['Cognitive Science'] = 'CogSci';
map['College Advising Seminars'] = 'COLA';
map['Commerce (McIntire School)'] = 'COMM';
map['Computer Science'] = 'CompSci';
map['Creative Writing'] = 'CreativeWriting';
map['Cross-Disciplinary Courses (ENGR)'] = 'ENGR';
map['Curriculum, Instruction, and Special Education'] = 'EDIS';
map['Data Science'] = 'DataScience';
map['Drama'] = 'Drama';
map['East Asian Languages, Literatures, and Cultures'] = 'EALC';
map['East Asian Studies'] = 'EAS';
map['Economics'] = 'Economics';
map['Education Leadership, Foundations, and Policy'] = 'EDLF';
map['Electrical and Computer Engineering'] = 'ECE';
map['Engaging the Liberal Arts'] = 'ELA';
map['English'] = 'English';
map['Environmental Sciences'] = 'EnviSci';
map['Environmental Thought and Practice'] = 'ETP';
map['European Studies'] = 'EuropeanStudies';
map['French Languages and Literatures'] = 'French';
map['German Languages and Literatures'] = 'German';
map['Global Citizenry in Action and in Translation'] = 'GCIAIT';
map['Global Studies'] = 'GS';
map['Global Sustainability'] = 'GlobalSustainability';
map['History'] = 'History';
map['Human Services'] = 'EDHS';
map['Institute of the Humanities and Global Culture'] = 'IHGC';
map['Interdisciplinary Studies'] = 'INST';
map['Jewish Studies'] = 'JWST';
map['Kinesiology'] = 'KINE';
map['Latin American Studies'] = 'LAS';
map['Law School'] = 'LAW';
map['Leadership and Public Policy'] = 'LEAD';
map['Liberal Arts Seminars'] = 'LASE';
map['Linguistics'] = 'Linguistics';
map['Materials Science and Engineering'] = 'MSE';
map['Mathematics'] = 'Mathematics';
map['Mechanical and Aerospace Engineering'] = 'MAE';
map['Media Studies'] = 'MDST';
map['Medical School'] = 'MED';
map['Medieval Studies'] = 'MSP';
map['Middle Eastern and South Asian Languages and Cultures'] = 'MESA';
map['Middle Eastern Studies'] = 'MESP';
map['Music'] = 'Music';
map['Neuroscience'] = 'Neuroscience';
map['Nursing School'] = 'NURS';
map['Pavillion Seminars'] = 'PAVS';
map['Philosophy'] = 'Philosophy';
map['Physics'] = 'Physics';
map['Political and Social Thought'] = 'PST';
map['Politics'] = 'Politics';
map['Psychology'] = 'Psychology';
map['Public Health Sciences'] = 'PHS';
map['Public Policy (Batten School)'] = 'PPOL';
map['Religious Studies'] = 'ReliStu';
map['Science, Technology, and Society'] = 'STS';
map['Slavic Languages and Literatures'] = 'Slavic';
map['Sociology'] = 'Sociology';
map['South Asian Studies'] = 'SASP';
map['Spanish, Italian, and Portuguese'] = 'SPAN';
map['Statistics'] = 'Statistics';
map['Systems and Information Engineering'] = 'SYS';
map['University Seminars'] = 'USEM';
map['Women, Gender, and Sexuality'] = 'WGS';
var suggested = {};
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
function round(value, decimals) {
    return (Number(Math.round(value + 'e' + decimals) + 'e-' + decimals));
}
$(function() {
    var fetchMajors = $.ajax({
	type: "POST",
	url: "controller.php?request=fetchMajors",
	dataType: "json"
    });
    fetchMajors.done(function(data) {
	var major1 = data[0]["area_of_study_1"];
	var major2 = data[0]["area_of_study_2"];
	var fetchClassSuggestions = $.ajax({
	    type: "POST",
	    url: "controller.php?request=fetchClassSuggestions",
	    data: {major1: major1, major2: major2},
	    dataType: "json"
	});
	fetchClassSuggestions.done(function(data) {
	    for (var i = 0; i < data.length; i++) {
		if (suggested[data[i]["title"]] == undefined) {
		    suggested[data[i]["title"]] = 1;
		}
		else {
		    suggested[data[i]["title"]] += 1;
		}
	    }
	    var dept1 = convertCourseToDepartment(major1);
	    var dept2 = convertCourseToDepartment(major2);
	    var courseCodes = [];
	    if (dept1 != undefined && dept2 == undefined) {
		var url1 = 'https://rabi.phys.virginia.edu/mySIS/CS2/page.php?Type=Group&Group=' + dept1;
		var encoded1 = encodeURIComponent(url1);
		$.getJSON('https://api.allorigins.ml/get?url=' + encoded1 + '&callback=?', function(data) {
		    var regex1 = data.contents.match(/(<tr><td class='UnitName' colspan='\d'>)[^<]*(<\/td><\/tr>)/gm);
		    if (regex1 != null) {
			regex1 = data.contents.match(/<span onmouseover="TCFOver\('[\d]*'\);" onmouseout="nd\(\);" onclick="TCF\('[\d]*'\);">[A-Za-z\s\d]*<\/span><\/td><td class='CourseName' colspan='[\d]*' onclick="ClassTip\('[A-Z]*','[\d]*'\);">[^>]*<\/td><\/tr>[^(<tr><td class='UnitName')]*/gm);
			if (regex1 != null) {
			    for (var i = 0; i < regex1.length; i++) {
				if (regex1[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm) != null && regex1[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm).length > 1) {
				    courseCodes.push(regex1[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm)[1]);
				}
			    }
			}
		    }
		    for (var i = 0; i < courseCodes.length; i++) {
			if (suggested[courseCodes[i]] == undefined) {
			    suggested[courseCodes[i]] = 1;
			}
			else {
			    suggested[courseCodes[i]] += 1;
			}
		    }
		    var sorted = Object.keys(suggested).map(function(key) {
			return [key, suggested[key]];
		    });
		    sorted.sort(function(first, second) {
			return second[1] - first[1];
		    });
		    if (document.getElementById("loading")) {
			document.getElementById("loading").remove();
		    }
		    var maxFrequency = 0;
		    if (sorted.length > 0) {
			maxFrequency = sorted[0][1];
		    }
		    for (var i = 0; i < sorted.length; i++) {
			if (sorted[i][1] > 1) {
			    var match = round((sorted[i][1] / maxFrequency) * 100, 0);
			    $("#classTable").append(
				'<tr><td>' + sorted[i][0] + '</td><td>' + match + '%</td></tr>'
			    );
			}
		    }
		    if (maxFrequency < 2) {
			if (document.getElementById("className")) {
			    document.getElementById("className").remove();
			}
			if (document.getElementById("percentMatch")) {
			    document.getElementById("percentMatch").remove();
			}
			$("#container").append(
			    '<h2>Unfortunately, no course suggestions can be provided at this time. This feature will become more robust as more users begin to use this application and accurately enter their major information and course history.</h2>'
			);
		    }
		});
	    }
	    else if (dept1 == undefined && dept2 != undefined) {
		var url2 = 'https://rabi.phys.virginia.edu/mySIS/CS2/page.php?Type=Group&Group=' + dept2;
		var encoded2 = encodeURIComponent(url2);
		$.getJSON('https://api.allorigins.ml/get?url=' + encoded2 + '&callback=?', function(data) {
		    var regex2 = data.contents.match(/(<tr><td class='UnitName' colspan='\d'>)[^<]*(<\/td><\/tr>)/gm);
		    if (regex2 != null) {
			regex2 = data.contents.match(/<span onmouseover="TCFOver\('[\d]*'\);" onmouseout="nd\(\);" onclick="TCF\('[\d]*'\);">[A-Za-z\s\d]*<\/span><\/td><td class='CourseName' colspan='[\d]*' onclick="ClassTip\('[A-Z]*','[\d]*'\);">[^>]*<\/td><\/tr>[^(<tr><td class='UnitName')]*/gm);
			if (regex2 != null) {
			    for (var i = 0; i < regex2.length; i++) {
				if (regex2[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm) != null && regex2[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm).length > 1) {
				    courseCodes.push(regex2[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm)[1]);
				}
			    }
			}
		    }
		    for (var i = 0; i < courseCodes.length; i++) {
			if (suggested[courseCodes[i]] == undefined) {
			    suggested[courseCodes[i]] = 1;
			}
			else {
			    suggested[courseCodes[i]] += 1;
			}
		    }
		    var sorted = Object.keys(suggested).map(function(key) {
			return [key, suggested[key]];
		    });
		    sorted.sort(function(first, second) {
			return second[1] - first[1];
		    });
		    if (document.getElementById("loading")) {
			document.getElementById("loading").remove();
		    }
		    var maxFrequency = 0;
		    if (sorted.length > 0) {
			maxFrequency = sorted[0][1];
		    }
		    for (var i = 0; i < sorted.length; i++) {
			if (sorted[i][1] > 1) {
			    var match = round((sorted[i][1] / maxFrequency) * 100, 0);
			    $("#classTable").append(
				'<tr><td>' + sorted[i][0] + '</td><td>' + match + '%</td></tr>'
			    );
			}
		    }
		    if (maxFrequency < 2) {
			if (document.getElementById("className")) {
			    document.getElementById("className").remove();
			}
			if (document.getElementById("percentMatch")) {
			    document.getElementById("percentMatch").remove();
			}
			$("#container").append(
			    '<h2>Unfortunately, no course suggestions can be provided at this time. This feature will become more robust as more users begin to use this application and accurately enter their major information and course history.</h2>'
			);
		    }
		});
	    }
	    else if (dept1 != undefined && dept2 != undefined) {
		var url1 = 'https://rabi.phys.virginia.edu/mySIS/CS2/page.php?Type=Group&Group=' + dept1;
		var encoded1 = encodeURIComponent(url1);
		var url2 = 'https://rabi.phys.virginia.edu/mySIS/CS2/page.php?Type=Group&Group=' + dept2;
		var encoded2 = encodeURIComponent(url2);
		$.getJSON('https://api.allorigins.ml/get?url=' + encoded1 + '&callback=?', function(data) {
		    var regex1 = data.contents.match(/(<tr><td class='UnitName' colspan='\d'>)[^<]*(<\/td><\/tr>)/gm);
		    if (regex1 != null) {
			regex1 = data.contents.match(/<span onmouseover="TCFOver\('[\d]*'\);" onmouseout="nd\(\);" onclick="TCF\('[\d]*'\);">[A-Za-z\s\d]*<\/span><\/td><td class='CourseName' colspan='[\d]*' onclick="ClassTip\('[A-Z]*','[\d]*'\);">[^>]*<\/td><\/tr>[^(<tr><td class='UnitName')]*/gm);
			if (regex1 != null) {
			    for (var i = 0; i < regex1.length; i++) {
				if (regex1[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm) != null && regex1[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm).length > 1) {
				    courseCodes.push(regex1[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm)[1]);
				}
			    }
			}
		    }
		    $.getJSON('https://api.allorigins.ml/get?url=' + encoded2 + '&callback=?', function(data) {
			var regex2 = data.contents.match(/(<tr><td class='UnitName' colspan='\d'>)[^<]*(<\/td><\/tr>)/gm);
			if (regex2 != null) {
			    regex2 = data.contents.match(/<span onmouseover="TCFOver\('[\d]*'\);" onmouseout="nd\(\);" onclick="TCF\('[\d]*'\);">[A-Za-z\s\d]*<\/span><\/td><td class='CourseName' colspan='[\d]*' onclick="ClassTip\('[A-Z]*','[\d]*'\);">[^>]*<\/td><\/tr>[^(<tr><td class='UnitName')]*/gm);
			    if (regex2 != null) {
				for (var i = 0; i < regex2.length; i++) {
				    if (regex2[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm) != null && regex2[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm).length > 1) {
					courseCodes.push(regex2[i].match(/>[^<]*</gm)[0].match(/[^><]*/gm)[1]);
				    }
				}
			    }
			}
			for (var i = 0; i < courseCodes.length; i++) {
			    if (suggested[courseCodes[i]] == undefined) {
				suggested[courseCodes[i]] = 1;
			    }
			    else {
				suggested[courseCodes[i]] += 1;
			    }
			}
			var sorted = Object.keys(suggested).map(function(key) {
			    return [key, suggested[key]];
			});
			sorted.sort(function(first, second) {
			    return second[1] - first[1];
			});
			if (document.getElementById("loading")) {
			    document.getElementById("loading").remove();
			}
			var maxFrequency = 0;
			if (sorted.length > 0) {
			    maxFrequency = sorted[0][1];
			}
			for (var i = 0; i < sorted.length; i++) {
			    if (sorted[i][1] > 1) {
				var match = round((sorted[i][1] / maxFrequency) * 100, 0);
				$("#classTable").append(
				    '<tr><td>' + sorted[i][0] + '</td><td>' + match + '%</td></tr>'
				);
			    }
			}
			if (maxFrequency < 2) {
			    if (document.getElementById("className")) {
				document.getElementById("className").remove();
			    }
			    if (document.getElementById("percentMatch")) {
				document.getElementById("percentMatch").remove();
			    }
			    $("#container").append(
				'<h2>Unfortunately, no course suggestions can be provided at this time. This feature will become more robust as more users begin to use this application and accurately enter their major information and course history.</h2>'
			    );
			}
		    });
		});
	    }
	    else {
		for (var i = 0; i < courseCodes.length; i++) {
		    if (suggested[courseCodes[i]] == undefined) {
			suggested[courseCodes[i]] = 1;
		    }
		    else {
			suggested[courseCodes[i]] += 1;
		    }
		}
		var sorted = Object.keys(suggested).map(function(key) {
		    return [key, suggested[key]];
		});
		sorted.sort(function(first, second) {
		    return second[1] - first[1];
		});
		if (document.getElementById("loading")) {
		    document.getElementById("loading").remove();
		}
		var maxFrequency = 0;
		if (sorted.length > 0) {
		    maxFrequency = sorted[0][1];
		}
		for (var i = 0; i < sorted.length; i++) {
		    if (sorted[i][1] > 1) {
			var match = round((sorted[i][1] / maxFrequency) * 100, 0);
			$("#classTable").append(
			    '<tr><td>' + sorted[i][0] + '</td><td>' + match + '%</td></tr>'
			);
		    }
		}
		if (maxFrequency < 2) {
		    if (document.getElementById("className")) {
			document.getElementById("className").remove();
		    }
		    if (document.getElementById("percentMatch")) {
			document.getElementById("percentMatch").remove();
		    }
		    $("#container").append(
			'<h2>Unfortunately, no course suggestions can be provided at this time. This feature will become more robust as more users begin to use this application and accurately enter their major information and course history.</h2>'
		    );
		}
	    }
	});
    });
});
