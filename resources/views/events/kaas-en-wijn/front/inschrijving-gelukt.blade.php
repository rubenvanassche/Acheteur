<!DOCTYPE HTML>
<!--
	Directive by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>@title()</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="@asset(js/ie/html5shiv.js)"></script><![endif]-->
			<link rel="stylesheet" href="@asset(css/skel.css)" />
			<link rel="stylesheet" href="@asset(css/style.css)" />
			<link rel="stylesheet" href="@asset(css/style-wide.css)" />
</head>
	<body>

		<!-- Main -->
			<div id="main">
				<div class="box container">
					<header>
						<h2>Inschrijving Gelukt @content(test)</h2>
					</header>
					@content(content-2)
              </div>

			</div>
			<script src="@asset(js/jquery.min.js)"></script>
			<script src="@asset(js/skel.min.js)"></script>
	</body>
</html>
