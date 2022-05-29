<?php

class actu {
    public $name;
    public $liste_de_sections;
    public $date_de_sortie;
    public $show_date;
  
    function __construct($name, $liste_de_sections, $date_de_sortie, $show_date) {
      $this->name = $name;
      $this->liste_de_sections = $liste_de_sections;
      $this->date_de_sortie = $date_de_sortie;
      $this->show_date = $show_date;
    }
    function get_name() {
      return $this->name;
    }
    
    function get_sections() {
        return $this->liste_de_sections;
     }

     function show_date() {
        return $this->show_date;
     }

     function get_date() {
        return $this->date_de_sortie;
     }
  }

  class actu_section {

    public $is_video;
    public $is_image;
    public $filepath;
    public $title;
    public $text;
  
    function __construct($is_video, $is_image, $filepath, $title, $text) {
      $this->is_video = $is_video;
      $this->is_image = $is_image;
      $this->filepath = $filepath;
      $this->title = $title;
      $this->text = $text;
    }

    function get_image_path(){
        return $this->filepath;
    }

    function get_video_path(){
        return $this->filepath;
    }
    
    function contains_video() {
        if ($this->is_video) {
            return true;
        }else{
            return false;
        }
    }

    function contains_image() {
        if ($this->is_image) {
            return true;
        }else{
            return false;
        }
    }

    
    function get_title() {
        return $this->title;
      }
      
    function get_text() {
        return $this->text;
      }

  }

?>