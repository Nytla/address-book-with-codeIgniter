<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to CodeIgniter</title>
		<link type="text/css" rel="stylesheet" media="all" href="/public/styles/style.css">
		<script type="text/javascript" src="/public/js/jquery-1.8.3.js"></script>
		<script type="text/javascript" src="/public/js/testing.js"></script>
	</head>
	<body>
		<div id="container">
			<h1>Welcome to CodeIgniter!</h1>
		
			<div id="body">
				<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>
		
				<p>If you would like to edit this page you'll find it located at:</p>
				<code>application/views/welcome_message.php</code>
		
				<p>The corresponding controller for this page is found at:</p>
				<code>application/controllers/welcome.php</code>
		
				<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
				<p>My name is <?=$first_name?> <?=$last_name?></p>
				<p>I am <?=$age?></p>
			</div>
		
			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
		</div>
		<div>
			<p>
				Login: <input type="text" name="login" id="login">
				<input type="button" name="butt" id="subm" value="Auth">
			</p>
		</div>
	</body>
</html>