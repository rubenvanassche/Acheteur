<!DOCTYPE HTML>
<!--
	Directive by Pixelarity
	pixelarity.com @pixelarity
	License: pixelarity.com/license
-->
<html>
	<head>
		<title>@title()</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script src="@asset(js/jquery.min.js)"></script>
		<script src="@asset(js/skel.min.js)"></script>
		<script src="@asset(js/init.js)"></script>
        @if (count($errors) > 0)
        <script>
          (function($) {
            $(function() {
            $('html,body').animate({
              scrollTop: $("#order").offset().top
            });
            });
          })(jQuery);

        </script>
      	@endif
		<noscript>
			<link rel="stylesheet" href="@asset(css/skel.css)" />
			<link rel="stylesheet" href="@asset(css/style.css)" />
			<link rel="stylesheet" href="@asset(css/style-wide.css)" />
		</noscript>
	</head>
	<body>

		<!-- Header -->
			<div id="header">
				<span class="logo icon fa-paper-plane-o"></span>
				<h1>@title()</h1>
				<p class="toMain">Lees meer @content(test) @content(test-1) <i class="fa fa-chevron-down"></i></p>
			</div>

		<!-- Main -->
			<div id="main">
				<div class="box container" style="text-align:center">
                  <h3>@title()</h3>
                  @content(content-3)
                  <ul class="actions">
						<li><div class="button toOrder">Inschrijven</div></li>
					</ul>
              	</div>

              	<div class="box container" style="text-align:center">
                  <h3>Waar</h3>
                  <p>Stella Maris - Blijde Inkomststraat</p>
				  <img style="width: 100%;height: auto;" src="http://scouts-zurenborg.be/evenementen/public/events/kaas-en-wijn/css/images/kaart.jpg"/>
          		</div>



				<footer class="major container 75%">
					<h3>Honger gekregen?</h3>
                  	<p>Schrijf dan nu in voor slechts €15<p>
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
								@product(aantal-personen-1)
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
	</body>
</html>
