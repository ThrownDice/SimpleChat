<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/20/15 020
 * Time: 1:36 PM
 */


class Vim {

	private $url;

	/**
	 * Constructor.
	 */
	function Vim() {
		// Get the url requested, if empty, fill in with "null" .
		if(isset($_GET['url'])) {
			$urlToTrim = explode("/", $_GET['url']);
			$this->url = $urlToTrim;
		} else {
			$this->url = array("0" => "null");
		}

	}

	function route() {
		switch($this->url[0]) {
			case "about":
				$this->enter("about");
				break;
			case "sns":
				$this->enter("sns");
				break;
			case "messenger":
				$this->enter("messenger");
				break;
			case "scanner":
				$this->enter("scanner");
				break;
			default:
				$this->enter("home");
				break;
		}
	}


	/**
	 * @param $controller
	 */
	function enter($controller) {
		$instance = new $controller();
		$instance->main();
	}

	function main() {

	}

}