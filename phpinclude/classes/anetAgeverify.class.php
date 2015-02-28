<?php

class anetAgeverify {
  private $dom;
  private $pdo;
  private $minage = 18;
  private $enterimage;
  private $exitlink = 'http://www.gogooligans.com/';
  private $rtalogo = '/siteimages/175x83_RTA-5042-1996-1400-1577-RTA.gif';
  
  private function settings() {
    $this->minage = 18;
    $this->enterimage = '/siteimages/AdultSplashAgeV.png';
    //$this->exitlink = 'http://lmgtfy.com/?q=My+Little+Pony';
  }
  
  public function splashscreen() {
    $splash = $this->dom->createElement('header');
    $splash->setAttribute('id', 'splashscreen');
    
    $heading = $this->dom->createElement('p', SITE_NAME . ' Social Network');
    $heading->setAttribute('class', 'headline');
    $splash->appendChild($heading);
    $heading = $this->dom->createElement('p', 'Brought to you by ' . COMPANY_NAME);
    $heading->setAttribute('class', 'tagline');
    $splash->appendChild($heading);
    
    $par = $this->dom->createElement('p', 'This site contains content of an adult nature that is not suitable for a younger audience.');
    addBr($this->dom, $par);
    addText($this->dom, $par, 'By entering this site, you agree that you are at least '. $this->minage . ' years of age and it is legal to view content of an adult nature where you are located.');
    $splash->appendChild($par);
    
    $enter = $this->dom->createElement('div');
    $enter->setAttribute('class', 'enter'); 
    $splash->appendChild($enter); 
  
    $img = $this->dom->createElement('img');
    $img->setAttribute('src', $this->enterimage);
    $img->setAttribute('alt', '[Enter Image]');
    $img->setAttribute('class', 'hothen');
    $enter->appendChild($img);
    
    $comein = $this->dom->createElement('div', 'Enter');
    $comein->setAttribute('id', 'AgeVerifyEnter');
    $comein->setAttribute('tabindex', '0');
    $comein->setAttribute('role', 'button');
    $title = '[Enter only if you are a legal adult over ' . $this->minage . ' years of age]';
    $comein->setAttribute('title', $title);
    $enter->appendChild($comein);
  
    $exit = $this->dom->createElement('div');
    $exit->setAttribute('id', 'AgeVerifyLeave');
    addLink($this->dom, $exit, $this->exitlink, 'Leave', '', '[Exit this web site]', 'nofollow');
    $enter->appendChild($exit);
    
    $anchor = $this->dom->createElement('a');
    $anchor->setAttribute('href', 'http://www.rtalabel.org/');
    $anchor->setAttribute('target', '_blank');
    $anchor->setAttribute('title', 'Visit RTALabel.org');
    $anchor->setAttribute('class', 'RTA');
    $anchor->setAttribute('rel', 'nofollow');
    $img = $this->dom->createElement('img');
    $img->setAttribute('src', $this->rtalogo);
    $img->setAttribute('width', '175');
    $img->setAttribute('height', '83');
    $img->setAttribute('alt', 'RTALabel Logo');
    $img->setAttribute('class', 'RTA');
    $anchor->appendChild($img);
    $enter->appendChild($anchor);
    
    $body = $this->dom->getElementsByTagName('body')->item(0);
    $ref = $body->firstChild;
    $body->insertBefore($splash, $ref);
  }
  
  public function anetAgeverify($dom, $pdo) {
    $this->dom = $dom;
    $this->pdo = $pdo;
    $this->settings();
  }

}

?>