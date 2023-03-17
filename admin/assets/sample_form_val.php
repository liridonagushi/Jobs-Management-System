<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery validation plug-in - main demo</title>
	<link rel="stylesheet" href="css/screen.css">
	<script src="../lib/jquery.js"></script>
	<script src="../dist/jquery.validate.js"></script>
	<script>
	$.validator.setDefaults({
		submitHandler: function() {
			alert("submitted!");
		}
	});

	$().ready(function() {
		// validate the comment form when it is submitted
		$("#commentForm").validate();

		// validate signup form on keyup and submit
		$("#signupForm").validate({
			rules: {
				firstname: "required",
				lastname: "required",
				username: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				// email: {
				// 	required: true,
				// 	email: true
				// },
               email:
                {
                    required: true,
                    email: true,
                    "remote":
                    {
                      url: 'validateEmail.php',
                      type: "post",
                      data:
                      {
                          email: function()
                          {
                              return $('#commentForm :input[name="email"]').val();
                          }
                      }
                    }
                },
				topic: {
					required: "#newsletter:checked",
					minlength: 2
				},
				agree: "required"
			},
			messages: {
				firstname: "Please enter your firstname",
				lastname: "Please enter your lastname",
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},

       email:
         {
            required: "Please enter your email email.",
            email: "Please enter a valid email email.",
            remote: jQuery.validator.format("{0} is already taken.")
         },
         
				agree: "Please accept our policy",
				topic: "Please select at least 2 topics"
			}
		});

		// propose username by combining first- and lastname
		$("#username").focus(function() {
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			if (firstname && lastname && !this.value) {
				this.value = firstname + "." + lastname;
			}
		});

		//code to hide topic selection, disable for demo
		var newsletter = $("#newsletter");
		// newsletter topics are optional, hide at first
		var inital = newsletter.is(":checked");
		var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
		var topicInputs = topics.find("input").attr("disabled", !inital);
		// show when newsletter is checked
		newsletter.click(function() {
			topics[this.checked ? "removeClass" : "addClass"]("gray");
			topicInputs.attr("disabled", !this.checked);
		});
	});
	</script>
	<style>
	#commentForm {
		width: 500px;
	}
	#commentForm label {
		width: 250px;
	}
	#commentForm label.error, #commentForm input.submit {
		margin-left: 253px;
	}
	#signupForm {
		width: 670px;
	}
	#signupForm label.error {
		margin-left: 10px;
		width: auto;
		display: inline;
	}
	#newsletter_topics label.error {
		display: none;
		margin-left: 103px;
	}
	</style>
</head>
<body>


<script type="text/javascript">
jQuery(function($){
       $("#subscribe_test3").submit(function(e){
          if ($(this).valid()){
               $.ajax( {
                   type: "POST",
                   url: "/save_subscriber.php",
                   data: "email="+$("#subscribe_test3_email").val(),
                   success: function(data){
                        $("#submit_result").html("Ajax submit results:" + data);
                   }
               });
          }
          return false;
    });
    $("#subscribe_test3").validate({ rules: {
         email: { maxlength: 32, remote: "check_subscribed.php" }
     }, messages: {
        email: { remote: "Already subscribed"}
     }
     });
});
</script>

<form id="subscribe_test3" action="save_subscriber.php" method="POST">
  <table>
    <tbody>
      <tr>
        <td><label>Email: *</label></td>
        <td><input id="subscribe_test3_email" class="email required" name="email" type="text" /></td>
      </tr>
      <tr>
        <td><input type="submit" /></td>
      </tr>
    </tbody>
  </table>
</form>

<h1 id="banner"><a href="http://jqueryvalidation.org/">jQuery Validation Plugin</a> Demo</h1>
<div id="main">
	<p>Default submitHandler is set to display an alert into of submitting the form</p>
	<form class="cmxform" id="commentForm" method="get" action="">
		<fieldset>
			<legend>Please provide your name, email address (won't be published) and a comment</legend>
			<p>
				<label for="cname">Name (required, at least 2 characters)</label>
				<input id="cname" name="name" minlength="2" type="text" required>
			</p>
			<p>
				<label for="email">E-Mail (required)</label>
				<input id="email" type="email" name="email" required>
			</p>
			<p>
				<label for="curl">URL (optional)</label>
				<input id="curl" type="url" name="url">
			</p>
			<p>
				<label for="ccomment">Your comment (required)</label>
				<textarea id="ccomment" name="comment" required></textarea>
			</p>
			<p>
				<input class="submit" type="submit" value="Submit">
			</p>
		</fieldset>
	</form>


</div>
</body>
</html>
