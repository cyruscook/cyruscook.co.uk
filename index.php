<!DOCTYPE html>
<html>
	<?php
	if(!( isset($_SERVER['HTTP_USER_AGENT'])  && preg_match('/bot|crawl|spider|mediapartners|slurp|patrol/i', $_SERVER['HTTP_USER_AGENT']) ))
	{
	?>
	<style>@keyframes spinner{to{transform:rotate(360deg)}}.spinner:before{content:'';box-sizing:border-box;position:absolute;top:50%;left:50%;width:50px;height:50px;margin-top:-25px;margin-left:-25px;border-radius:50%;border:3px solid transparent;border-top-color:#00202A;animation:spinner 1s ease-in-out infinite}</style>
	<div id="LoadingScreen"><style>#LoadingScreen{z-index:999;height:100vh;width:100vw;top:0;position:fixed;background-color:#ededed}</style>
	<div class="spinner"></div>
	<script>var LSDate=Date.now();addEventListener("pageshow",()=>{var e=()=>{document.getElementById("LoadingScreen").parentNode.removeChild(document.getElementById("LoadingScreen"))};Date.now()-LSDate>=750?e():setTimeout(e,Date.now()+750-Date.now())});</script></div>
	<?php
	}
	?>
	<head>
		<meta charset="utf-8">
		<!-- This disables zooming -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

		<title>Cyrus Cook</title>


		<!-- SEO -->

		<link rel="canonical"		href="https://www.cyruscook.co.uk">
		<meta name="description"	content="Software Engineer and Developer">

		<!-- FaceBook Markup -->
		<meta property="og:url"			content="https://www.cyruscook.co.uk">
		<meta property="og:title"		content="Cyrus Cook">
		<meta property="og:description"	content="Software Engineer and Developer">

		<!-- Twitter Markup -->
		<meta name="twitter:card"			content="summary">
		<meta name="twitter:url"			content="https://www.cyruscook.co.uk">
		<meta name="twitter:title"			content="Cyrus Cook">
		<meta name="twitter:description"	content="Software Engineer and Developer">

		<!-- /SEO -->
		
		<!-- Style sheets, rendering asyncronously to allow for the loading screen, thank you https://keithclark.co.uk/articles/loading-css-without-blocking-render/ -->
		<!-- Bootstrap -->
		<link rel="stylesheet" href="bootstrap.4.3.1.min.css">
		
		<!-- Font Awesome, for icons -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		
		<!-- Personal Stylesheet -->
		<link rel="stylesheet" href="style.css">
	</head>
	<body>

	<!-- Recaptcha email verification modal -->
	<div class="modal fade" id="emailVerificationModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body" id="emailVerificationModal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="email-content">
						<div class="spinner captcha-spinner"></div>
						<div class="recaptcha-holder"></div>
						<small>This site is protected by reCAPTCHA and the Google 
							<a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> and
							<a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.
						</small>
					</div>
				</div>
			</div>
		</div>
	</div>	

		<section class="section intro" data-section-name="intro">
			<div class="title">
				<h1>Cyrus Cook</h1>
				<p>
					I am a 16 year old Software Engineer and Developer with 7 years of experience and knowledge in over 8 languages and frameworks.
				</p>
				<div class="sm-dock">
					<a href="https://github.com/cyruscook" target="_blank" class="sm-icon">
						<i class="fab fa-github"></i>
					</a>
					<a href="https://linkedin.com/in/cyruscook/" target="_blank" class="sm-icon">
						<i class="fab fa-linkedin"></i>
					</a>
					<a class="sm-icon" onclick="getEmail();">
						<i class="fas fa-envelope"></i>
					</a>
				</div>
			</div>
			<div class="intro-chevron">
				<a onclick="$.scrollify.move('#languages');" class="sm-icon">
					<i class="fas fa-chevron-down"></i>
				</a>
			</div>
		</section>
		
		<section class="section ask-me" data-section-name="more">
			<!--
			<div class="lang-icons">
				<i class="fab fa-html5 lang-icon"></i>
				<i class="fab fa-css3-alt lang-icon"></i>
				<i class="fab fa-js-square lang-icon"></i>
				<i class="fab fa-php lang-icon"></i>
				<i class="fab fa-node-js lang-icon"></i>
				<i class="fab fa-python lang-icon"></i>
				<img src="ue4_icon.svg" draggable="false" class="lang-icon">
			</div>-->
			<div class="search">
				<p>Ask me anything!</p>
				<div class="question">
					<input type="text" onkeydown="search(this);">
					<div class="complete">What programming languages do you know?</div>
				</div>
				<div class="answer">
					<p class="answer-text">
					</p>
				</div>
			</div>
		</section>

		<!-- Jquery -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Scrollify -->
		<script src="scrollify.1.0.19.min.js"></script>
		<!-- Bootstrap -->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<!-- Personal JS -->
		<script src="script.js"></script>

		<!-- Google Recaptcha -->
		<script src="https://www.google.com/recaptcha/api.js?onload=renderCaptcha&render=explicit" async defer></script>

		<!-- Elasticunr -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/elasticlunr/0.9.6/elasticlunr.min.js"></script>
	</body>
</html>