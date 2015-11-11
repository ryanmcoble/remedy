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

		section {
			top: 0;
		    bottom: 0;
		    left: 0;
		    right: 0;
		    margin: auto;
		    width: 200px;
		    height: 200px;
		    position: absolute;
		    overflow: auto;
		    border: solid #777 2px;
		    padding-top: 12px;
			text-align:center;
		}

		section img {
			width: 200px;
		}

		section .shopify-hidden {
			position: absolute;
		    top: 0;
		    left: 0;
		    opacity: .05;
		}

		h1 {
			font-size: 32px;
			margin: 0;
			position: absolute;
			line-height: 200px;
			width: 100%;
			top: 0;
			left: 0;
		}


		p {
			color: #ddd;
			font-size: 12px;
			position: absolute;
			bottom: 0;
			width: 100%;
		}

	</style>
</head>
<body>
	<section>
		<img class="shopify-hidden" src="{{ asset('assets/images/shopify-bag.png') }}" alt="Shopify">
		<h1>Remedy.</h1>
		<p class="coming-soon">Coming soon...</p>
	</section>
</body>
</html>
