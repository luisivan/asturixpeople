$(document).ready(function () {
	loadLoginWidget();
	loadCategoriesWidget();
	$.history.init(checkState);
});

var spinner = '<div class="loading"><img class="spinner" src="images/spinner.gif" /></div>';

function checkState(hash) {
	if(hash != "") {
		var hashArray = hash.split("/");
		var real = hashArray.shift();
		var parameters = hashArray.join("', '");
		if (parameters == undefined) {
			eval(real + "()");
		} else {
			eval(real + "('"+parameters+"')");
		}
	} else {
		home();
	}
}

function loadHome() {
	location.hash = "home";
	$.ajax({
		beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/home.php",
		//url: "ajax/hot.php",
		//data: {page:1},
		success: function(data) {
			$("#content").html(data);
		}
	});
}

function showLoginWidget() {
	$("#login").slideToggle();
}

function onForgotButton() {
	location.hash = "forgot";
	$.ajax({
	  	beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/forgotForm.php",
		success: function(data) {
			$("#content").html(data);
		}
	});
}

function onLoginButton() {
	$.ajax({
		url: "ajax/auth.php",
		data: "user=" + $("#user").val() + "&pass=" + $("#pass").val(),
		success: function(data) {
			$("#loginBar").html(data);
			loadHome();
		}
	});
}

function onLoginEnter(event) {
var key=event.keyCode || event.which;
if (key==13){
	$.ajax({
		url: "ajax/auth.php",
		data: "user=" + $("#user").val() + "&pass=" + $("#pass").val(),
		success: function(data) {
			$("#loginBar").html(data);
			loadHome();
		}
	});
}
}

function onLogoutButton() {
	$.ajax({
		url: "ajax/logout.php",
		success: function(data) {
			$("#loginBar").html(data);
			loadHome();
		}
	});
}

function onProfileButton() {
  	location.hash = "editProfile";
	$.ajax({
		beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/profile.php",
		success: function(data) {
			$("#content").html(data);
			loadEditor("infoInput");
			previewPhoto();
			$("#profileForm").validate({
			submitHandler: function(form) {
				onProfileUpdated();
			}
			});
		}
	});
}

function onPasswordButton() {
  	location.hash = "changePass";
	$.ajax({
		beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/password.php",
		success: function(data) {
			$("#content").html(data);
		}
	});
}

function onRegisterButton() {
	location.hash = "signup";
	$.ajax({
		beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/signupForm.php",
		success: function(data) {
			$("#content").html(data);
			loadEditor("infoInput");
		}
	});
}

function onNewIdeaButton() {
  	location.hash = "newIdea";
	$.ajax({
		beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/newIdea.php",
		success: function(data) {
			$("#content").html(data);
			loadEditor("descInput");
		}
	});
}

function onSignupSubmit() {
  if ($("#signUp input").valid() == true) {
	$.ajax({
		type: "POST",
		url: "ajax/signup.php",
		data: {user:$("#userInput").val(),pass:$("#passInput").val(),email:$("#emailInput").val(),name:$("#nameInput").val(),info:CKEDITOR.instances.infoInput.getData(),photo:$("#photoInput").val()},
		success: function(data) {
			$("#content").prepend(data);
		}
	});
  }
}

function onProfileUpdated() {
  if ($("#profileForm input").valid() == true) {
	$.ajax({
		type: "POST",
		url: "ajax/updateProfile.php",
		data: {user:$("#userInput").val(),email:$("#emailInput").val(),name:$("#nameInput").val(),info:CKEDITOR.instances.infoInput.getData(),photo:$("#photoInput").val()},
		success: function(data) {
			$("#content").prepend(data);
		}
	});
	$.ajax({
		url: "ajax/islogged.php",
		success: function(data) {
			$("#login").html(data);
		}
	});
  }
}

function changePassword() {
  if ($("#passwordForm").valid() == true) {
	$.ajax({
		type: "POST",
		url: "ajax/updatePassword.php",
		data: {pass:$("#passInput").val()},
		success: function(data) {
			$("#content").prepend(data);
		}
	});
  }
}

function lostPasswordMail() {
  if ($("#recoverForm").valid() == true) {
	$.ajax({
		type: "POST",
		url: "ajax/forgot.php",
		data: {email:$("#emailInput").val()},
		success: function(data) {
			$("#content").prepend(data);
		}
	});
  }
}

function onIdeaUpdated(id) {
  if ($("#editIdea").valid() == true) {
	$.ajax({
		type: "POST",
		url: "ajax/updateIdea.php",
		data: {id:id,name:$("#nameInput").val(),description:CKEDITOR.instances.descInput.getData(),open:$("input:radio[name=open]:checked").val(),category:$("#categoryInput").val()},
		success: function(data) {
			$("#content").prepend(data);
			loadCategoriesWidget();
		}
	});
	viewIdea(id);
  }
}

function editIdea(id) {
    	location.hash = "editIdea/"+id;
	$.ajax({
		beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/editIdea.php",
		data: "id=" + id,
		success: function(data) {
			$("#content").html(data);
			loadEditor("descInput");
		}
	});
}

function onProfileDeleted() {
	var popup = confirm("Do you want to delete your profile?");
	if (popup == true) {
		$.ajax({
			url: "ajax/deleteProfile.php",
			success: function(data) {
				$("#content").prepend(data);
			}
		});
		onLogoutButton();
		loadHome();
	}
}

function deleteIdea(id) {
	var popup = confirm("Do you want to delete this idea?");
	if (popup == true) {
		$.ajax({
			url: "ajax/deleteIdea.php",
			data: "id=" + id,
			success: function(data) {
				$("#content").prepend(data);
				loadCategoriesWidget();
			}
		});
		loadHome();
	}
}

function onNewIdea() {
  if ($("#newIdea").valid() == true) {
	$.ajax({
		type: "POST",
		url: "ajax/sendIdea.php",
		data: {name:$("#nameInput").val(),description:CKEDITOR.instances.descInput.getData(),category:$("#categoryInput").val()},
		success: function(data) {
			$("#content").prepend(data);
			loadCategoriesWidget();
			loadHome();
		}
	});
  }	
}

function voteIdeaUp(id) {
	$.ajax({
		url: "ajax/voteIdeaUp.php",
		data: "id=" + id,
		success: function(data) {
			$("#content").prepend(data);
		}
	});
}

function voteIdeaDown(id) {
	$.ajax({
		url: "ajax/voteIdeaDown.php",
		data: "id=" + id,
		success: function(data) {
			$("#content").prepend(data);
		}
	});
}

function voteIdeaAbstention(id) {
	$.ajax({
		url: "ajax/voteIdeaAbstention.php",
		data: "id=" + id,
		success: function(data) {
			$("#content").prepend(data);
		}
	});
}

function viewIdea(id) {
	location.hash = "idea/"+id;
	$.ajax({
	  	beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/viewIdea.php",
		data: "id=" + id,
		success: function(data) {
			$("#content").html(data);
		}
	});
}

function viewProfile(user) {
    	location.hash = "user/"+user;
	$.ajax({
	  	beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/viewProfile.php",
		data: "user=" + user,
		success: function(data) {
			$("#content").html(data);
		}
	});
}

function viewCategory(id, page) {
  	if (page == undefined)
	{
	  page = 1;
	}
    	location.hash = "category/"+id+"/"+page;
  	$.ajax({
	  	beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/viewCategory.php",
		data: "id=" + id + "&page=" + page,
		success: function(data) {
			$("#content").html(data);
		}
	});
}

function loadLoginWidget() {
	$.ajax({
		url: "ajax/islogged.php",
		success: function(data) {
			$("#loginBar").html(data);
		}
	});
}

function loadCategoriesWidget() {
	$.ajax({
		url: "ajax/categoriesWidget.php",
		success: function(data) {
			$("#categories").html(data);
		}
	});
}

function onSearchButton(event) {
var key=event.keyCode || event.which;
if (key==13){
search($("#search").val(), 1);
}
}

function search(text, page) {
if (text.length < 4) {
  alert("You must introduce 4 characters or more");
} else {
  	if (page == undefined)
	{
	  page = 1;
	}
	location.hash = "search/"+text+"/"+page;
	$.ajax({
	    	beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/search.php",
		data: "text=" + text + "&page=" + page,
		success: function(data) {
			$("#content").html(data);
		}
	});
}
}

function viewHotIdeas(page) {
	if (page == undefined)
	{
	  page = 1;
	}
    	location.hash = "hot/"+page;
  	$.ajax({
	  	beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/hot.php",
		data: "page=" + page,
		success: function(data) {
			$("#content").html(data);
		}
	});
}

function viewLastIdeas(page) {
  	if (page == undefined)
	{
	  page = 1;
	}
    	location.hash = "last/"+page;
  	$.ajax({
	  	beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/last.php",
		data: "page=" + page,
		success: function(data) {
			$("#content").html(data);
		}
	});
}

function viewApprovedIdeas(page) {
	if (page == undefined)
	{
	  page = 1;
	}
	location.hash = "approved/"+page;
	$.ajax({
	  	beforeSend: function() {
			$("#content").html(spinner);
		},
		url: "ajax/approved.php",
		data: "page=" + page,
		success: function(data) {
			$("#content").html(data);
		}
	});
}

function recoverPassword(email, hash) {
  if ($("#recoverForm").valid() == true) {
	$.ajax({
		type: "POST",
		url: "ajax/recover.php",
		data: {email:email,hash:hash},
		success: function(data) {
			$("#content").html(data);
		}
	});
  }
}

function previewPhoto() {
	$("#photoPreview").html('<img width="70" height="70" align="top" src=' + $("#photoInput").val() + ' />');
}

function loadEditor(id)
{
    var instance = CKEDITOR.instances[id];
    if (instance)
    {
        //CKEDITOR.remove(instance);
        //CKEDITOR.instances[id].destroy();
        delete CKEDITOR.instances[id];
    }
    CKEDITOR.config.protectedSource.push( /<\?[\s\S]*?\?>/g );   // PHP Code
    //CKEDITOR.config.entities = false;
    CKEDITOR.config.defaultLanguage = 'es';
    //$('#'+id).ckeditor();
    CKEDITOR.replace(id);
}

function commentsIframe()
{
  /*while ($("#comments").contents().find("#dsq-content").css("margin-top") != "0px")
  {*/
    $("#comments").contents().find("#dsq-content").css("margin-top", 40);
    $("#comments").height($("#comments").contents().find("#dsq-content").height()+40);
    $("#comments").contents().find("#dsq-content").resize(function() {
    $("#comments").height($("#comments").contents().find("#dsq-content").height()+40);
  });
  //}
}