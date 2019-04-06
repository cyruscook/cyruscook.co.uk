$(document).ready(() => {

	// Initialise Scrollify
	$.scrollify({
		section : "section.section",
		scrollSpeed: 900,
		scrollbars: false,
	});

	// Check the users cookies for a stored email and place this in the email box
	var foundEmail = cookie.get("email");
	// See if the user has the email stored as a cookie, if they do then there's no need to bother with the captcha
	if(foundEmail)
	{
		hasGotEmail = true;
		$("#emailVerificationModal-body > div.email-content")[0].innerHTML = "Please do not hesitate to contact me at:<br><a class='captcha-email' href='mailto:" + foundEmail + "'>" + foundEmail + "</a>";
	}

	// Intialise Elasticlunr
	elasticSearch = elasticlunr(function () {
		this.addField('question');
		this.addField('answer');
		this.setRef('id');
	});

	// Define questions + Answers
	var questions = [
		{
			"id": 1,
			"question": "What programming languages do you know?",
			"answer": "HTML, CSS, Javascript, PHP, Python"
		},
		{
			"id": 2,
			"question": "How old are you?",
			"answer": "16"
		},
		{
			"id": 2,
			"question": "What is your age?",
			"answer": "16"
		},
		{
			"id": 3,
			"question": "What's your name?",
			"answer": "Cyrus"
		},
		{
			"id": 4,
			"question": "What projects have you previously worked on?",
			"answer": "..."
		},
		{
			"id": 4,
			"question": "That's really cool",
			"answer": "Thank you!"
		}
	];

	// Add them to the doc DB
	questions.forEach(value => {
		elasticSearch.addDoc(value);
	});

	// Elastic has already stored a copy of the questions, so we can delete them from memory
	questions = undefined;
	delete questions;

	// Set up search function
	// Search the questions ignoring the answers, and return the most likely answer
	search = input => {
		$("div.answer > p.answer-text")[0].style["opacity"] = "0.5";

		// Search for the term the user entered into the input
		var matches = elasticSearch.search(input.value, {
			fields: {
				question: {boost: 1},
				// Dont search in a question's answer
				answer: {boost: 0}
			}
		});

		// If there was a match
		if(matches.length > 0)
		{
			// Extract the most likely match.
			var match =  {
				"question": matches[0].doc.question,
				"answer": matches[0].doc.answer,
				"score": matches[0].score
			}

			console.dir(match);

			// If the use has currently not entered a correct question
			if($("div.complete")[0].innerHTML.toLowerCase() !== match.question.toLowerCase() || true)
			{
				// Set the auto suggestion to the question
				$("div.complete")[0].innerHTML = match.question;
			
				// And set the result box to the answer
				$("div.answer > p.answer-text")[0].innerHTML = match.answer;
			}
		}
		else
		{
			// Otherwise show default message
			$("div.complete")[0].innerHTML = "What programming languages do you know?";
		}
	};
});

var hasGotEmail = false;
var captchaId;
var search = () => {};
var elasticSearch;

var renderCaptcha = () => {
	if(!hasGotEmail)
	{
		var captcha = $('.recaptcha-holder')[0];
	
		captchaId = grecaptcha.render(captcha, {
			'sitekey': '6LcwZJwUAAAAAJYQ7kKGdLVeO4kqMMdnWTi3307Y',
			// Development Site Key, will allow all requests
			//'sitekey': '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
			'size': 'invisible',
			'badge' : 'inline', // possible values: bottomright, bottomleft, inline
			'callback' : (token) => {
				console.log("Callback Issued, token = " + token);
				
				// We have recieved a token from google, let's send this to the front end and hope it gives us the email back
				var request = $.ajax({
					url: "getemail.php",
					method: "GET",
					data: {
						captcha : token 
					},
					dataType: "text"
				});
				
				request.done(data => {
					console.log(data);
					if(data != "Failure")
					{
						// If it did give us the email back, add it to the modal
						$("#emailVerificationModal-body > div.email-content")[0].innerHTML = "Please do not hesitate to contact me at:<br><a class='captcha-email' href='mailto:" + data + "'>" + data + "</a>";
						hasGotEmail = true;
						cookie.set("email", data, 5);
					}
					else
					{
						// Otherwise we'll reload the page for them to try again
						location.reload();
					}
				});
				
				request.fail((jqXHR, textStatus) => {
					$("#emailVerificationModal-body > div.email-content").innerHTML = "We encountered an error: " + textStatus + "<br>Please reload and try again.";
				});
			}
		});
	}
};

var getEmail = () => {
	if(!hasGotEmail)
	{
		grecaptcha.execute(captchaId);
	}
	$('#emailVerificationModal').modal('show');
}



// Thank you W3
cookie = {
	set: (cname, cvalue, exdays) =>
	{
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	},
	
	get: (cname) =>
	{
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i < ca.length; i++)
		{
			var c = ca[i];
			while (c.charAt(0) == ' ')
			{
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0)
			{
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
}