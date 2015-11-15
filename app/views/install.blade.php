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

		section.install {
			max-width: 800px;
			width: 80%;
			margin: 0 auto;
			text-align: center;
		}

	</style>
</head>
<body>

	<section class="install">
		<h1>Install Remedy</h1>
		<p>To install Remedy enter your shop's domain (without the "https://" or "http://").</p>
		<form action="/install" method="post">
			<input name="domain" value="">
			<button type="submit">Generate Install URL</button>
		</form>

		@if($install_url)
		<p>{{ $install_url }}</p>
		@endif
	</section>

</body>
</html>