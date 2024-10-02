<?php

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="Author" content="SKYMON RMM | Fonet Bilgi Teknolojileri A.S." />
		<title>You are using an outdated browser.</title>
		<link rel="icon" href="favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="assets/img/apple-touch-icon-76x76-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="assets/img/apple-touch-icon-120x120-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="assets/img/apple-touch-icon-152x152-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="180x180" href="assets/img/apple-touch-icon-180x180-precomposed.png">
		<link rel="icon" sizes="192x192" href="assets/img/touch-icon-192x192.png">
		<meta name="msapplication-TileImage" content="assets/img/ms-tile-144x144.png">
		<meta name="msapplication-TileColor" content="#d40000">
		<meta name="msapplication-config" content="none"/>
		<link rel="stylesheet" type="text/css" href="assets/styles/<?= ZBX_DEFAULT_THEME ?>.css" />
	</head>
	<body lang="en">
		<main>
			<div class="<?= ZBX_STYLE_BROWSER_WARNING_CONTAINER ?>">
				<h2 class="<?= ZBX_STYLE_RED ?>">You are using an outdated browser.</h2>
				<p>Skymon frontend is built on advanced, modern technologies and does not support old browsers. It is highly recommended that you choose and install a modern browser. It is free of charge and only takes a couple of minutes.</p>
				<p>New browsers usually come with support for new technologies, increasing web page speed, better privacy settings and so on. They also resolve security and functional issues.</p>
				<ul>
					<li>
						<a target="_blank" href="http://www.google.com/chrome"><div class="<?= ZBX_STYLE_BROWSER_LOGO_CHROME ?>"></div></a>
						<a target="_blank" href="http://www.google.com/chrome">Google Chrome</a>
					</li>
					<li>
						<a target="_blank" href="http://www.mozilla.org/firefox"><div class="<?= ZBX_STYLE_BROWSER_LOGO_FF ?>"></div></a>
						<a target="_blank" href="http://www.mozilla.org/firefox">Mozilla Firefox</a>
					</li>
					<li>
						<a target="_blank" href="http://windows.microsoft.com/en-US/internet-explorer/downloads/ie"><div class="<?= ZBX_STYLE_BROWSER_LOGO_IE ?>"></div></a>
						<a target="_blank" href="http://windows.microsoft.com/en-US/internet-explorer/downloads/ie">Internet Explorer</a>
					</li>
					<li>
						<a target="_blank" href="http://www.opera.com/download"><div class="<?= ZBX_STYLE_BROWSER_LOGO_OPERA ?>"></div></a>
						<a target="_blank" href="http://www.opera.com/download">Opera browser</a>
					</li>
					<li>
						<a target="_blank" href="http://www.apple.com/safari/download"><div class="<?= ZBX_STYLE_BROWSER_LOGO_SAFARI ?>"></div></a>
						<a target="_blank" href="http://www.apple.com/safari/download">Apple Safari</a>
					</li>
				</ul>
				<div class="<?= ZBX_STYLE_BROWSER_WARNING_FOOTER ?>">
					<a href="index.php" onClick="javascript: document.cookie='browserwarning_ignore=yes';">Continue despite this warning</a>
				</div>
			</div>
		</main>

		<?php
			$footer = makePageFooter(false);
			echo $footer->toString();
		?>
	</body>
</html>
