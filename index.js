// DRA
$(function() {
    var count = 0;
    var update = setInterval(function() {
	var updateDiscussion = $.ajax({
	    type: "POST",
	    url: "controller.php?request=fetchDiscussion",
	    data: {course: "", number: "", at: "", hashtag: "", post: "%%"},
	    dataType: "json"
	});
	updateDiscussion.done(function(data) {
	    if (count != data.length) {
		var parent_node = document.getElementById("discussionContainer");
		if (parent_node) {
		    while (parent_node.firstChild) {
			parent_node.removeChild(parent_node.firstChild);
		    }
		}
		count = 0;
		for (var i = 0; i < data.length; i++) {
		    count++;
		    if (data[i]["at"] != "" && data[i]["hashtag"] != "") {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (<a class="searchInPost" id="!' + data[i]["computing_id"] + '">' + data[i]["computing_id"] + '</a>) ' + data[i]["course"] + ' ' + data[i]["number"] + ' <a class="searchInPost" id="@' + data[i]["at"] + '">@' + data[i]["at"] + '</a> <a class="searchInPost" id="#' + data[i]["hashtag"] + '">#' + data[i]["hashtag"] + '</a></strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		    else if (data[i]["at"] != "" && data[i]["hashtag"] == "") {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (<a class="searchInPost" id="!' + data[i]["computing_id"] + '">' + data[i]["computing_id"] + '</a>) ' + data[i]["course"] + ' ' + data[i]["number"] + ' <a class="searchInPost" id="@' + data[i]["at"] + '">@' + data[i]["at"] + '</a></strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		    else if (data[i]["at"] == "" && data[i]["hashtag"] != "") {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (<a class="searchInPost" id="!' + data[i]["computing_id"] + '">' + data[i]["computing_id"] + '</a>) ' + data[i]["course"] + ' ' + data[i]["number"] + ' <a class="searchInPost" id="#' + data[i]["hashtag"] + '">#' + data[i]["hashtag"] + '</a></strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		    else {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (<a class="searchInPost" id="!' + data[i]["computing_id"] + '">' + data[i]["computing_id"] + '</a>) ' + data[i]["course"] + ' ' + data[i]["number"] + '</strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		}
	    }
	});
	$(".searchInPost").click(function(evt) {
	    clearInterval(update);
	    var id = evt.target.id;
	    var parent_node = document.getElementById("discussionContainer");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    var at = "";
	    var hashtag = "";
	    if (id.substring(0, 1) == '!' || id.substring(0, 1) == '@') {
		at = id.substring(1);
	    }
	    if (id.substring(0, 1) == "#") {
		hashtag = id.substring(1);
	    }
	    var searchDiscussionFromHyperlink = $.ajax({
		type: "POST",
		url: "controller.php?request=fetchDiscussion",
		data: {course: "", number: "", at: at, hashtag: hashtag, post: "%%"},
		dataType: "json"
	    });
	    searchDiscussionFromHyperlink.done(function(data) {
		if (parent_node) {
		    while (parent_node.firstChild) {
			parent_node.removeChild(parent_node.firstChild);
		    }
		}
		for (var i = 0; i < data.length; i++) {
		    if (data[i]["at"] != "" && data[i]["hashtag"] != "") {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (' + data[i]["computing_id"] + ') ' + data[i]["course"] + ' ' + data[i]["number"] + ' @' + data[i]["at"] + ' #' + data[i]["hashtag"] + '</strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		    else if (data[i]["at"] != "" && data[i]["hashtag"] == "") {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (' + data[i]["computing_id"] + ') ' + data[i]["course"] + ' ' + data[i]["number"] + ' @' + data[i]["at"] + '</strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		    else if (data[i]["at"] == "" && data[i]["hashtag"] != "") {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (' + data[i]["computing_id"] + ') ' + data[i]["course"] + ' ' + data[i]["number"] + ' #' + data[i]["hashtag"] + '</strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		    else {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (' + data[i]["computing_id"] + ') ' + data[i]["course"] + ' ' + data[i]["number"] + '</strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		}
	    });
	});
    }, 1000);
    $("#searchPosts").click(function(evt) {
	clearInterval(update);
	var course = $("#course").val();
	var number = $("#number").val();
	var at = $("#at").val();
	var hashtag = $("#hashtag").val();
	var post = $("#post").val();
	var inputCharactersNotPermitted = new RegExp("[<>]");
	if (course.length > 4 || inputCharactersNotPermitted.test(course)) {
	    alert("Invalid Course");
	}
	else if (number.length > 4 || inputCharactersNotPermitted.test(number)) {
	    alert("Invalid Number");
	}
	else if (at.length > 10 || inputCharactersNotPermitted.test(at)) {
	    alert("Invalid @");
	}
	else if (hashtag.length > 20 || inputCharactersNotPermitted.test(hashtag)) {
	    alert("Invalid #");
	}
	else if (post.length > 160 || inputCharactersNotPermitted.test(post)) {
	    alert("Invalid Post");
	}
	else {
	    var parent_node = document.getElementById("discussionContainer");
	    if (parent_node) {
		while (parent_node.firstChild) {
		    parent_node.removeChild(parent_node.firstChild);
		}
	    }
	    var regexPost = "%" + post + "%";
	    var searchDiscussion = $.ajax({
		type: "POST",
		url: "controller.php?request=fetchDiscussion",
		data: {course: course, number: number, at: at, hashtag: hashtag, post: regexPost},
		dataType: "json"
	    });
	    searchDiscussion.done(function(data) {
		if (parent_node) {
		    while (parent_node.firstChild) {
			parent_node.removeChild(parent_node.firstChild);
		    }
		}
		for (var i = 0; i < data.length; i++) {
		    if (data[i]["at"] != "" && data[i]["hashtag"] != "") {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (' + data[i]["computing_id"] + ') ' + data[i]["course"] + ' ' + data[i]["number"] + ' @' + data[i]["at"] + ' #' + data[i]["hashtag"] + '</strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		    else if (data[i]["at"] != "" && data[i]["hashtag"] == "") {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (' + data[i]["computing_id"] + ') ' + data[i]["course"] + ' ' + data[i]["number"] + ' @' + data[i]["at"] + '</strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		    else if (data[i]["at"] == "" && data[i]["hashtag"] != "") {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (' + data[i]["computing_id"] + ') ' + data[i]["course"] + ' ' + data[i]["number"] + ' #' + data[i]["hashtag"] + '</strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		    else {
			$("#discussionContainer").append(
			    '<p class="timestamp">' + data[i]["timestamp"] + '</p><p><strong>' + data[i]["first_name"] + ' (' + data[i]["computing_id"] + ') ' + data[i]["course"] + ' ' + data[i]["number"] + '</strong> ' + data[i]["post"] + '</p><hr>'
			);
		    }
		}
	    });
	}
    });
    $("#postPost").click(function(evt) {
	var course = $("#course").val();
	var number = $("#number").val();
	var at = $("#at").val();
	var hashtag = $("#hashtag").val();
	var post = $("#post").val();
	var inputCharactersNotPermitted = new RegExp("[<>]");
	if (course.length > 4 || inputCharactersNotPermitted.test(course)) {
	    alert("Invalid Course");
	}
	else if (number.length > 4 || inputCharactersNotPermitted.test(number)) {
	    alert("Invalid Number");
	}
	else if (at.length > 10 || inputCharactersNotPermitted.test(at)) {
	    alert("Invalid @");
	}
	else if (hashtag.length > 20 || inputCharactersNotPermitted.test(hashtag)) {
	    alert("Invalid #");
	}
	else if (post.length < 1 || post.length > 160 || inputCharactersNotPermitted.test(post)) {
	    alert("Invalid Post");
	}	
	else {
	    var postComment = $.ajax({
		type: "POST",
		url: "controller.php?request=postComment",
		data: {course: course, number: number, at: at, hashtag: hashtag, post: post},
		dataType: "text"
	    });
	    postComment.done(function(data) {
		if (data != "error") {
		    $("#course").val("");
		    $("#number").val("");
		    $("#at").val("");
		    $("#hashtag").val("");
		    $("#post").val("");
		    var count = 0;
		    update;
		}
		else {
		    alert("We have detected that you are attempting to perform a JavaScript or SQL injection, which is against the site's terms of use policy. We have temporarily disabled your account while it is being reviewed.");
		    window.location = 'index.php';
		}
	    });
	}
    });
});
