<?php

namespace TenJava\Tools\UI;

class NavigationItem {
	private $title;
	private $url;
	private $active = false;

	public function __construct($title, $url) {
		$this->title = $title;
		$this->url = $url;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getUrl() {
		return $this->url;
	}

	public function setActive($bool=true){
		$this->active = $bool;
	}

	public function isActive(){
		return $this->active;
	}
}
