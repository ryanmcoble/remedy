<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Remedy</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			color: #777;
		}

		section.intro {
			top: 0;
		    bottom: 0;
		    left: 0;
		    right: 0;
		    margin: auto;
		    width: 200px;
		    height: 200px;
		    position: absolute;
		    overflow: auto;
		    border: solid #333 1px;
		    padding-top: 12px;
			text-align:center;
			box-shadow: 0 0 2px 1px #444;
		}

		section.intro img {
			width: 200px;
		}

		section.intro .shopify-hidden {
			position: absolute;
		    top: 0;
		    left: 0;
		    opacity: .05;
		}

		section.intro h1 {
			font-size: 32px;
			margin: 0;
			position: absolute;
			line-height: 200px;
			width: 100%;
			top: 0;
			left: 0;
			text-shadow: 0 0 1px #444;
		}


		section.intro p {
			color: #ddd;
			font-size: 14px;
			position: absolute;
			bottom: 0;
			width: 100%;
			/*text-shadow: 0 0 4px #444;*/
		}

		span.percent-completion {
			color: limegreen;
		}


		section.stats {
			top: 0;
		    bottom: 0;
		    left: 0;
		    right: 0;
		    margin: 0 auto;
		    max-width: 800px;
		    width: 100%;
		    height: 124px;
		    position: absolute;
		    padding-top: 12px;
			text-align:center;
		}

		.api-key {
			font-size: 12px;
		}

	</style>
</head>
<body>

	@if($apiKey)
	<section class="stats">
		<h1>https://{{ $apiKey->shop->domain }}</h1>
		<p class="api-key">API Key: {{ $apiKey->public_key }}</p>
		<p>Current Plan: {{ $apiKey->access_level->title }} <a href="#">Upgrade Now</a>!</p>
		<p>Rate Limit: {{ $apiKey->access_level->request_limit }} requests, every {{ $apiKey->access_level->interval_value }} {{ $apiKey->access_level->interval_type }}(s)</p>
	</section>
	@endif

	<section class="intro">
		<img class="shopify-hidden" src="{{ asset('assets/images/shopify-bag.png') }}" alt="Shopify">
		<h1>Remedy.</h1>
		<p class="coming-soon">Version 1.0 =  <span class="percent-completion">75%</span></p>
	</section>

</body>
</html>
