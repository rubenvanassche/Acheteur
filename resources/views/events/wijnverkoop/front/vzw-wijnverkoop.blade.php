<!DOCTYPE HTML>
<!--
	Highlights by HTML5 UP
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
		<!--[if lte IE 9]><link rel="stylesheet" href="@asset(css/ie9.css)" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<section id="header">
				<header class="major">
					<h1>@title()</h1>
					<p>@content(ondertitel)</p>
				</header>
				<div class="container">
					<ul class="actions">
						<li><span class="button special toMain">Meer info</span></li>
					</ul>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="main special">
				<div class="container">
					<div class="content">
						@content(tekst)

            <span class="button special toOrder">Bestellen</span>
					</div>
				</div>
			</section>


		<!-- Footer -->
			<section id="footer">
				<div class="container">
					<header class="major">
						<h2>Bestellen</h2>
					</header>
						@openform()
						<div class="row uniform">
							@if (count($errors) > 0)
							<div class="12u$">
							<b>{{ trans('errors.somethingwentwrong') }}</b><br/>
								@foreach ($errors->all() as $error)
								<span>{{ $error }}</span><br />
								@endforeach
						</div>
							@endif

              <div class="12u$"><label>Naam</label>@field(name)</div>
              <div class="12u$"><label>Email Adres</label>@field(email)</div>
              <div class="12u$"><h4>Hoeveelheden</h4></div>
							<div class="12u$"><label><b>Cava</b> €8,5</label>@product(cava)</div>
              <div class="6u 12u$(xsmall)"><label><b>Wit</b> €7</label>@product(wit)</div>
              <div class="6u$ 12u$(xsmall)"><label><b>Wit(6 flessen)</b> €33,5</label>@product(doos-wit-6-flessen)</div>
							<div class="6u 12u$(xsmall)"><label><b>Rood</b> €7</label>@product(rood)</div>
              <div class="6u$ 12u$(xsmall)"><label><b>Rood(6 flessen)</b> €33,5</label>@product(doos-rood-6-flessen)</div>
							<div class="12u$"><label><b>Duo rood-wit(1 fles rood, 1 fles wit)</b> €12</label>@product(duo-rood-wit)</div>
							<div class="12u$"><label><b>Doos gemengd(3 flessen rood, 3 flessen wit)</b> €33,5</label>@product(doos-gemengd-3-rood-3-wit)</div>
              <div class="12u$">
                <ul class="actions">
              		@submit(Bestellen)
                </ul>
              </div>
              @closeform()
						</div>
				</div>
				<footer>
				</footer>
			</section>

		<!-- Scripts -->
			<script src="@asset(js/jquery.min.js)"></script>
			<script src="@asset(js/jquery.scrollex.min.js)"></script>
			<script src="@asset(js/jquery.scrolly.min.js)"></script>
			<script src="@asset(js/skel.min.js)"></script>
			<script src="@asset(js/util.js)"></script>
			<!--[if lte IE 8]><script src="@asset(js/ie/respond.min.js)"></script><![endif]-->
			<script src="@asset(js/main.js)"></script>
			@if (count($errors) > 0)
				<script>
					(function($) {
										$('html,body').animate({
			scrollTop: $("#footer").offset().top
			});
									})(jQuery);

				</script>
			@endif

	</body>
</html>
