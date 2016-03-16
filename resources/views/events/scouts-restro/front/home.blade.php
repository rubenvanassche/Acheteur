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
		<link rel="stylesheet" href="@asset(css/main.css)" />
		<!--[if lte IE 8]><link rel="stylesheet" href="@asset(css/ie8.css)" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<div id="header">
				<span class="logo icon fa-cutlery"></span>
				<h1>Scouts Restro</h1>
				<p class="toMain">Lees Meer <i class="fa fa-chevron-down"></i><p>
			</div>

		<!-- Main -->
			<div id="main">
				<div class="box container">
					<header>
						<h2>Scouts Restro</h2>
					</header>
					@content(content-1)
                  	<ul class="actions">
						<li><div class="button toOrder">Inschrijven</div></li>
					</ul>
				</div>


				<div class="container box" style="text-align:center;">
  				@content(extra-content)
				</div>

				<footer class="major container 75%">
					<h3>Honger gekregen?</h3>
					<p>Schrijf je dan nu in voor slechts €20</p>
					<ul class="actions">
						<li><div class="button toOrder">Inschrijven</div></li>
					</ul>
				</footer>

			</div>

		<!-- Footer -->
			<div id="footer">
				<div class="container 75%">

					<header class="major last" id="order">
						<h2>Inschrijven</h2>
					</header>

					@content(inschrijven-content)
                  
                  @if (count($errors) > 0)
                  <b style="color=red;">{{ trans('errors.somethingwentwrong') }}</b>
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li style="color=red;">{{ $error }}</li>
                    @endforeach
                  </ul>
                @endif

					@openform()
						<div class="row">
							<div class="6u 12u(mobilep)">
                              <label style="color:white;">Naam</label>
								@field(name)
							</div>
							<div class="6u 12u(mobilep)">
                              <label style="color:white;">Email Addres</label>
								@field(email) 
							</div>
						</div>
                  		<div class="row">
							<div class="12u">
                              <label style="color:white;">Aantal personen</label>
								@product(aantal-personen)
							</div>
						</div>
                        <div class="row">
							<div class="12u">
                              <label style="color:white;">Aantal personen(enkel dessert)</label>
								@product(enkel-dessert)
							</div>
						</div>
						<div class="row" style="margin-bottom: 20px;">
							<div class="12u">
                              	<label style="color:white;">Opmerkingen</label>
								@field(comments)
							</div>
						</div>
                  	@submit(Inschrijven)
					@closeform()

				</div>
			</div>

		<!-- Scripts -->
			<script src="@asset(js/jquery.min.js)"></script>
			<script src="@asset(js/skel.min.js)"></script>
			<script src="@asset(js/util.js)"></script>
			<!--[if lte IE 8]><script src="@asset(js/ie/respond.min.js)"></script><![endif]-->
			<script src="@asset(js/main.js)"></script>
      		@if (count($errors) > 0)
      			<script>
      				(function($) {
                      	$('html,body').animate({
	 scrollTop: $("#order").offset().top
	 });
                      })(jQuery);

      			</script>
      		@endif

	</body>
</html>
