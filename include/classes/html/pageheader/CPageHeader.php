<?php

/**
 * Class for rendering html page head part.
 */
class CPageHeader {

	/**
	 * @var string page title
	 */
	protected $title;

	/**
	 * @var array of css file paths
	 */
	protected $cssFiles = [];

	/**
	 * @var array of css styles
	 */
	protected $styles = [];

	/**
	 * @var array of js file paths
	 */
	protected $jsFiles = [];

	/**
	 * @var array of js scripts to render before js files
	 */
	protected $jsBefore = [];

	/**
	 * @var array of js scripts to render after js files
	 */
	protected $js = [];

	/**
	* @var {string} sid
	*/
	protected $sid;

	/**
	 * @param string $title
	 */
	public function __construct($title = '') {
		$this->title = CHtml::encode($title);
		$this->sid = substr(get_cookie(ZBX_SESSION_NAME), 16, 16);
	}

	/**
	 * Add path to css file to render in page head.
	 *
	 * @param string $path
	 */
	public function addCssFile($path) {
		$this->cssFiles[$path] = $path;
		return $this;
	}

	/**
	 * Add css style to render in page head.
	 *
	 * @param string $style
	 */
	public function addStyle($style) {
		$this->styles[] = $style;
		return $this;
	}

	/**
	 * Add path to js file to render in page head.
	 *
	 * @param string $path
	 */
	public function addJsFile($path) {
		$this->jsFiles[$path] = $path;
		return $this;
	}

	/**
	 * Add js script to render in page head after js file includes are rendered.
	 *
	 * @param string $js
	 */
	public function addJs($js) {
		$this->js[] = $js;
		return $this;
	}

	/**
	 * Add js script to render in page head before js file includes are rendered.
	 *
	 * @param string $js
	 */
	public function addJsBeforeScripts($js) {
		$this->jsBefore[] = $js;
		return $this;
	}

	/**
	 * Display page head html.
	 */
	public function display() {
		echo <<<HTML
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="Author" content="SKYMON RMM | Fonet Bilgi Teknolojileri A.S." />
		<title>$this->title</title>
		<link rel="icon" href="favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="assets/img/apple-touch-icon-76x76-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="assets/img/apple-touch-icon-120x120-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="assets/img/apple-touch-icon-152x152-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="180x180" href="assets/img/apple-touch-icon-180x180-precomposed.png">
		<link rel="icon" sizes="192x192" href="assets/img/touch-icon-192x192.png">
		<meta name="csrf-token" content="$this->sid"/>
		<meta name="msapplication-TileImage" content="assets/img/ms-tile-144x144.png">
		<meta name="msapplication-TileColor" content="#d40000">
		<meta name="msapplication-config" content="none"/>

HTML;

		foreach ($this->cssFiles as $path) {
			// Add query string only to theme css files.
			if (in_array($path, ['assets/styles/blue-theme.css', 'assets/styles/dark-theme.css',
						'assets/styles/hc-light.css', 'assets/styles/hc-dark.css'
					])) {
				$path .= '?'.(int) filemtime($path);
			}

			echo '<link rel="stylesheet" type="text/css" href="'.$path.'" />'."\n";
		}

		if ($this->styles) {
			echo '<style type="text/css">';
			echo implode("\n", $this->styles);
			echo '</style>';
		}

		if ($this->jsBefore) {
			echo '<script>';
			echo implode("\n", $this->jsBefore);
			echo '</script>';
		}

		foreach ($this->jsFiles as $path) {
			echo '<script src="'.$path.'"></script>'."\n";
		}

		if ($this->js) {
			echo '<script>';
			echo implode("\n", $this->js);
			echo '</script>';
		}

		echo '</head>'."\n";
		return $this;
	}
}
