<?php

class anetAgeverify {
  private $dom;
  private $pdo;
  private $minage = 18;
  private $enterimage = '/img/plugins/anet.plugin.ageverify/AdultSplashAgeV.png';
  private $exitlink = 'http://www.gogooligans.com/';
  private $rtalogo = '/img/plugins/anet.plugin.ageverify/RTAlogo.gif';
  
  private function settings() {
    $cache = new wrapCache();
    $APC = 'anet.plugin.ageverify.settings';
    if(! $settings = $cache->fetch($APC)) {
      $settings = array();
      $sql = "SELECT settings FROM plugins WHERE vend='anet' AND name='ageverify'";
      $q = $this->pdo->query($sql);
      if($rs = $q->fetchAll()) {
        $string = $rs[0]->settings;
        if(strlen($string) > 0) {
          $a = explode('|', $string);
          $n = count($a);
          for($i=0; $i<$n; $i++) {
            $t = $a[$i];
            $b = explode('=', $t);
            if(count($b) > 0) {
              $key = trim($b[0]); $val = trim($b[1]);
              if(strlen($key) > 0) {
                $settings[$key] = $val;
              }
            }
          }
        }
      }
      $cache->store($APC, $settings, (60 * 60 * 24));
    }
    if(isset($settings['minage'])) {
      $minage = round(0 + $settings['minage']);
      if($minage > 18) {
        $this->minage = $minage;
      }
    }
    if(isset($settings['exitlink'])) {
      //FIXME validate URL
      $exitlink = trim($settings['exitlink']);
      $this->exitlink = $exitlink;
    }
    //FIXME alternate image,rtalogo resource
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