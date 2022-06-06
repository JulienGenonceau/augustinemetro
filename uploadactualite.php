<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/actualites.css">
    <link rel="stylesheet" href="assets/css/upload_actualites.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Actualités</title>
</head>
<body>

<?php
    include 'configuration_page_accueil.php';
    include 'assets/php/connecttodb.php';
    //include 'assets/includes/navbar.php';
    include 'assets/php/actuobj.php';
    ?>

    <div class="bodycontainer">

    <div class="leftpart">
    <h3> Publier une actualité </h3>

    <?php
        $name = "Exemple de nom d'article";
        $liste_de_sections = [new actu_section(false, false, "",  "Titre exemple", "Description exemple")];
        $date_de_sortie = date("Y-m-d");
        $show_date = true;
        $actualite = new actu($name, $liste_de_sections, $date_de_sortie, $show_date);

        echo "<p>Nom de l'article</p>";
        echo '<input id="actu_name_input" type="text" value="'.$name.'" maxlength="50"></input>'
    ?>

<label class="container">
  <input id="input_show_date" type="checkbox" checked="checked">
  <span class="checkmark">Afficher la date de publication</span>
</label>

    <div id="leftpart_sectionscontainer">

    <?php

    for ($i = 0; $i < count($actualite->get_sections()); $i++){
        $title = $actualite->get_sections()[$i]->get_title();
        $desc =  $actualite->get_sections()[$i]->get_text();
        echo '
        <div class="section_actu">
        <p class="sectionleftpartitle">Section 1</p>
        <p>Image OU Vidéo</p>
        <input type="file" name=""></input>
        <p>Titre</p>
        <input type="text" name="" value="'.$title.'" maxlength="100"></input>
        <p>Texte</p>
        <div class="cont">
        <div id="editor" contenteditable="false">
            <section id="toolbar">
                <div id="bold" class="icon fa fa-bold">B</div>
                <div id="italic" class="icon fa fa-italic">I</div>
                <div id="createLink" class="icon fa fa-link">lien</div>
                <div id="insertUnorderedList" class="icon fa fa-list">liste1</div>
                <div id="insertOrderedList" class="icon fa fa-list-ol">liste2</div>
                <div id="justifyLeft" class="icon fa fa-align-left">left</div>
                <div id="justifyRight" class="icon fa fa-align-right">right</div>
                <div id="justifyCenter" class="icon fa fa-align-center">center</div>
                <div id="justifyFull" class="icon fa fa-align-justify">full</div>
            </section>
    
            <div id="page" contenteditable="true">'.$desc.'</div>
        </div>
        </div>
        
        <p class="btnn" onclick="DeleteSection('.$i.')">Supprimer la section</p>
    </div>
    
    </div>
    
        ';
    }

    ?>
    
    <p class="btnn" onclick="AddNewSection();">Ajouter une section +</p>

    <p class="btnn" onclick="valider_et_publier();">Publier l'article ✔️</p>

    </div>

    <div class="preview">

    </div>
    


    <div id="newsection_contenu">
    <div class="section_actu">
        <p class="sectionleftpartitle">Section </p>
        <p>Image OU Vidéo</p>
        <input type="file" name=""></input>
        <p>Titre</p>
        <input type="text" name="" value="" maxlength="100"></input>
        <p>Texte</p>
        <div class="cont">
        <div id="editor" contenteditable="false">
            <section id="toolbar">
                <div id="bold" class="icon fa fa-bold">B</div>
                <div id="italic" class="icon fa fa-italic">I</div>
                <div id="createLink" class="icon fa fa-link">lien</div>
                <div id="insertUnorderedList" class="icon fa fa-list">liste1</div>
                <div id="insertOrderedList" class="icon fa fa-list-ol">liste2</div>
                <div id="justifyLeft" class="icon fa fa-align-left">left</div>
                <div id="justifyRight" class="icon fa fa-align-right">right</div>
                <div id="justifyCenter" class="icon fa fa-align-center">center</div>
                <div id="justifyFull" class="icon fa fa-align-justify">full</div>
            </section>
    
            <div id="page" contenteditable="true"></div>
        </div>
        <button class="log-out-client" onclick="getContent();">
            <i class="fa fa-save"></i>
            <span>Save content</span>
        </button>
        </div>
        
        <p class="btnn">Supprimer la section</p>
    </div>
    </div>
    
    </div>

    </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <script>

      function AddNewSection(){
          $('#leftpart_sectionscontainer').append(document.getElementById('newsection_contenu').innerHTML);

          var allsections = document.getElementsByClassName('section_actu');
          var lastSection = allsections[allsections.length - 2];
          lastSection.children[0].innerText += " "+String(allsections.length-1);
          const index = allsections.length - 2
          lastSection.children[7].onclick = function(){
              DeleteSection(index);
          }
      }

      function DeleteSection(id) {
          var allsections = document.getElementsByClassName('section_actu');
          var sectionToDelete = allsections[id];
          allsections[id].style.opacity = 0;
          setTimeout(
          function(){
              $(allsections[id]).remove()
              resetAllIds();
          }
          , 500);
      }

      function resetAllIds() {
          
        var allsections = document.getElementsByClassName('section_actu');
          for (var i = 0; i < allsections.length-1; i++){
              
          const index = i
          var lastSection = allsections[i];
          lastSection.children[0].innerText = "Section "+String(i+1);
          lastSection.children[7].onclick = function(){
              DeleteSection(index);
          }

          }
      }

var ghostEditor = {
  bindEvents: function() {
    this.bindDesignModeToggle();
    this.bindToolbarButtons();
  },

  bindDesignModeToggle: function() {
    $('#page-content').on('click', function(e) {
      document.designMode = 'on';
    });

    $('#page-content').on('click', function(e) {
      var $target = $(e.target);

      if ($target.is('#page-content')) {
        document.designMode = 'off';
      }
    });
  },

  bindToolbarButtons: function() {
    $('#toolbar').on('mousedown', '.icon', function(e) {
      e.preventDefault();
      var btnId = $(e.target).attr('id');
      this.editStyle(btnId);
    }.bind(this));
  },

  editStyle: function(btnId) {
    var value = null;

    if (btnId === 'createLink') {
      if (this.isSelection()) value = prompt('Enter a link:');
    }

    document.execCommand(btnId, true, value);
  },

  isSelection: function() {
    var selection = window.getSelection();
    return selection.anchorOffset !== selection.focusOffset
  },

  init: function() {
    this.bindEvents();
  },
}

ghostEditor.init();

function getContent() {
	var content = document.getElementById('page').innerHTML;
	alert(content);
}

function valider_et_publier(){

    const name = document.getElementById('actu_name_input').value;
    const date_de_sortie = new Date();
    const show_date = document.getElementById('input_show_date').checked;

    var allsections = document.getElementsByClassName('section_actu');
              
    var list_is_video = [];
    var list_is_image = [];
    var list_filepath = [];
    var list_title = [];
    var list_text = [];
    
    for (var i = 0; i < allsections.length-1; i++){
        var fullPath = allsections[i].children[2].value;
        if (fullPath) {
    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    var filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
    list_is_video.push(isVideo(filename))
    list_is_image.push(isImage(filename))
    list_filepath.push(filename);
}else{
    list_is_video.push(false)
    list_is_image.push(false)
    list_filepath.push("");
}
    list_title.push(allsections[i].children[4].value)
    list_text.push(allsections[i].children[6].children[0].children[1].innerHTML)
    

    }

    var allsections = document.getElementsByClassName('section_actu');
    let formData = new FormData();
    const number_of_files = allsections.length-1
    formData.append("number_of_files", number_of_files);
    for (var i = 0; i < number_of_files; i++){
        let photo = allsections[i].children[2].files[0];

        if (photo != null){
        console.log(photo.name)
        if (isImage(photo.name) || isVideo(photo.name)){
         formData.append("file"+String(i), photo);
        }}
    }

  $.ajax({
    // Your server script to process the upload
    url: 'assets/php/uploadactualitetraitement_fileupload.php',
    type: 'POST',

    // Form data
    data: formData,

    // Tell jQuery not to process data or worry about content-type
    // You *must* include these options!
    cache: false,
    contentType: false,
    processData: false,
         success: function(data) {
             $('body').html(data);
        }
  });

    $.post('assets/php/uploadactualitetraitement.php', {
    name : name,
    date_de_sortie : date_de_sortie,
    show_date : show_date,
    list_is_video : list_is_video,
    list_is_image : list_is_image,
    list_filepath : list_filepath,
    list_title : list_title,
    list_text : list_text
    }, 
    function(returnedData){
         $('body').append(returnedData);
});

}

function getExtension(filename) {
  var parts = filename.split('.');
  return parts[parts.length - 1];
}

function isImage(filename) {
  var ext = getExtension(filename);
  switch (ext.toLowerCase()) {
    case 'jpg':
    case 'gif':
    case 'bmp':
    case 'png':
      //etc
      return true;
  }
  return false;
}

function isVideo(filename) {
  var ext = getExtension(filename);
  switch (ext.toLowerCase()) {
    case 'm4v':
    case 'avi':
    case 'mpg':
    case 'mp4':
      // etc
      return true;
  }
  return false;
}

refresh_preview();
function refresh_preview() {

  $('.preview').html('');
    const name = document.getElementById('actu_name_input').value;
  $('.preview').append("<p class='actu_title'>"+name+"</p>");

  var allsections = document.getElementsByClassName('section_actu');

  var image_first = true;

          for (var i = 0; i < allsections.length-1; i++){

            //check si la section est vide ou non
            if (section_contains_image(i) || section_contains_video(i) || allsections[i].children[4].value.length>0 || allsections[i].children[6].children[0].children[1].innerText.length>0){


            div_actu_section = document.createElement("div");
            div_actu_section.className = 'actu_section_container';

        if (image_first){
            show_image_or_video(i, div_actu_section);
            show_title_and_text(i, div_actu_section);
        }else{
            show_title_and_text(i, div_actu_section);
            show_image_or_video(i, div_actu_section);
        }
    
        if (section_contains_image(i) || section_contains_video(i)){
        image_first = !image_first;}
        
          $('.preview').append(div_actu_section)

          }

        }


}

function show_image_or_video(i, div_actu_section) {
  if (section_contains_image(i)){
    div_section_item = document.createElement("div");
    div_section_item.className = 'actu_section_item';

    div_img = document.createElement("img");
    div_img.id = "image"+String(i);
    var allsections = document.getElementsByClassName('section_actu');
    readURL( allsections[i].children[2], i)
    div_img.className = "actu_img";

    div_section_item.appendChild(div_img);

    div_actu_section.appendChild(div_section_item);
  }
}

function show_title_and_text(i, div_actu_section){
  
  var allsections = document.getElementsByClassName('section_actu');

  if (allsections[i].children[4].value.length>0 || allsections[i].children[6].children[0].children[1].innerText.length>0){

    div_section_item = document.createElement("div");
    div_section_item.className = 'actu_section_item';

            if (allsections[i].children[4].value.length>0){
              div_title = document.createElement("p");
              div_title.className = 'actu_section_title';
              div_title.innerHTML = allsections[i].children[4].value;
              div_section_item.append(div_title);
            }

            if (allsections[i].children[6].children[0].children[1].innerText.length>0){
              div_title = document.createElement("p");
              div_title.className = 'actu_section_text';
              div_title.innerHTML = allsections[i].children[6].children[0].children[1].innerHTML;
              div_section_item.append(div_title);
            }
    
                
        }

        
    div_actu_section.appendChild(div_section_item);
  
}

function section_contains_image(i){
  var allsections = document.getElementsByClassName('section_actu');
  if (allsections[i].children[2].files.length > 0){
    var fullPath = allsections[i].children[2].value;
    if (fullPath) {
    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    var filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
    if (isImage(filename)){
      return true;
    }else{
      return false;
    }
  }
  }else{
    return false;
  }
}

function section_contains_video(i){
  var allsections = document.getElementsByClassName('section_actu');
  if (allsections[i].children[2].files.length > 0){
    var fullPath = allsections[i].children[2].value;
    if (fullPath) {
    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    var filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
    if (isVideo(filename)){
      return true;
    }else{
      return false;
    }
  }
  }else{
    return false;
  }
}

$('body').on('click', function(){
  refresh_preview();
})

function readURL(input, i) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image'+String(i))
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

  </script>
</body>
</html>