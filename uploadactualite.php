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

    if (!isset($_POST['uname'])){
      $getttt = "";
      if (isset($_GET['actumodif'])){
        $getttt = "?actumodif=".$_GET['actumodif'];
      };
      echo('<form action="uploadactualite.php'.$getttt.'" method="post">');
      ?>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Login</button>
    </form>
      <?php
      
    die();
    }else{
      if ($_POST['uname']!="augustinemetro@orange.fr" || $_POST['psw']!="SAuyP6MnIe5t"){
        die();
      }
    }

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

        if (isset($_GET['actumodif'])){

        $stmt = $db->query("SELECT * FROM actu WHERE actu_id =".$_GET['actumodif']);
        $lastactu = $stmt->fetch();
            
        $name = $lastactu['actu_nom'];
        $date_de_sortie = $lastactu['actu_date'];
        $show_date = true;
        if($lastactu['actu_showdate']==0){$show_date = false;}
        $lastactu_ID = $lastactu['actu_id'];
        
        $stmt = $db->query("SELECT * FROM actusection WHERE actusection_actuid =".$_GET['actumodif']);
        
        $liste_de_sections = [];
          while ($row = $stmt->fetch()) {
            $row_isvideo = false;
            $row_isimage = false;
            if ($row['actusection_is_video']=='1'){$row_isvideo = true;}
            if ($row['actusection_is_image']=='1'){$row_isimage = true;}
        
            $row_filepath = $row['actusection_filepath'];
            $row_title = $row['actusection_title'];
            $row_desc = $row['actusection_desc'];
            
            $liste_de_sections[] = new actu_section($row_isvideo, $row_isimage, $row_filepath,  $row_title, $row_desc);
        }
        
      //  $section = new actu_section(false, false, "",  "Titre exemple", "Description exemple"); // a suppr
      //  $liste_de_sections[] = $section; // a suppr

        $actualite = new actu($name, $liste_de_sections, $date_de_sortie, $show_date);
        }

        echo "<p>Nom de l'article</p>";
        echo '<input id="actu_name_input" type="text" value="'.$name.'" maxlength="50"></input>'
    ?>

<label class="container">
  <input id="input_show_date" type="checkbox" checked="checked">
  <span class="checkmark">Afficher la date de publication</span>
</label>

    <div id="leftpart_sectionscontainer">

    <?php

    //for ($i = 0; $i < count($actualite->get_sections()); $i++){
      for ($i = 0; $i < 1; $i++){
        $title = $actualite->get_sections()[$i]->get_title();
        $desc =  $actualite->get_sections()[$i]->get_text();
          echo '
          <div class="section_actu">
          <p class="sectionleftpartitle">Section '.($i+1).'</p>
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

    <p class="btnn" onclick="ShowCRUD();">Modifier / Supprimer des articles</p>

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
    var list_newpaths = [];
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
    
    const extensionname = filename.substring(filename.lastIndexOf("."));
    const newname = randomString(99)+extensionname;

    list_filepath.push(newname);
    list_newpaths.push(newname);

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
        if (isImage(photo.name) || isVideo(photo.name)){
         formData.append("file"+String(i), photo, list_newpaths[i]);
        }
      }
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

refresh_preview(true);
function refresh_preview(withvideos) {

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
            show_image_or_video(i, div_actu_section, withvideos);
            show_title_and_text(i, div_actu_section);
        }else{
            show_title_and_text(i, div_actu_section);
            show_image_or_video(i, div_actu_section, withvideos);
        }
    
        if (section_contains_image(i) || section_contains_video(i)){
        image_first = !image_first;}
        
          $('.preview').append(div_actu_section)

          }

        }


}

function show_image_or_video(i, div_actu_section, withvideos) {
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
  if (section_contains_video(i)){

    div_section_item = document.createElement("div");
    div_section_item.className = 'actu_section_item';

    div_video = document.createElement("video");
    div_video.id = "video"+String(i);
    div_video.className = "actu_video";

    if (withvideos){
    var allsections = document.getElementsByClassName('section_actu');
    input =  allsections[i].children[2];

     const files = input.files || [];

  if (!files.length) return;
  
  const reader = new FileReader();
  const video = div_video;
  video.setAttribute("controls","controls") ;
  const videoSource = document.createElement('source');

  reader.onload = function (e) {
    videoSource.setAttribute('src', e.target.result);
    video.appendChild(videoSource);
    video.load();
    video.play();
    video.pause();
  };
  
  reader.onprogress = function (e) {
    console.log('progress: ', Math.round((e.loaded * 100) / e.total));
  };
  
  reader.readAsDataURL(files[0]);
}else{
   const btn_actualise =  document.createElement('div');
   btn_actualise.innerText = "Cliquez pour actualiser la ou les vidéos";
   btn_actualise.className = "btn_actualise_videos"
   div_section_item.appendChild(btn_actualise);
   btn_actualise.onclick = function() {
      refresh_preview(true);
   }
}

    div_section_item.appendChild(div_video);
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

$('input').on('change', function(){
  refresh_preview(false);
})

$('body').on('keyup', function(){
  refresh_preview(false);
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

        
  function ShowCRUD(){
    const div_crud = document.createElement("div");
    div_crud.className = "divcrud";
    document.body.appendChild(div_crud);

    const div_croix  = document.createElement("div");
    div_croix.className = "close";
    div_crud.appendChild(div_croix);

    div_croix.onclick = function(){
      $('.divcrud').remove();
    }

    const actus_container = document.createElement("div");
    actus_container.className = "crud_actus_container"
    div_crud.appendChild(actus_container);

    $.post("assets/php/get_actu_crud.php",
    {
      data1: ""
    },
    function(data){
      actus_container.innerHTML = data;

    $('.actu_crudlist').each(function(i, obj){
      const div_actu = document.createElement("div");
      div_actu.className = "actu_cruditem";
      actus_container.appendChild(div_actu);

      const div_name = document.createElement("p");
      div_name.innerText = obj.innerText;
      div_actu.appendChild(div_name);

      const div_modifier = document.createElement("div");
      div_modifier.className = "div_modifier"
      div_actu.appendChild(div_modifier);

      const div_supprimer = document.createElement("div");
      div_supprimer.className = "div_supprimer"
      div_actu.appendChild(div_supprimer);

      div_modifier.onclick = function() {
        window.location.replace("uploadactualite.php?actumodif="+obj.id);
      }

      div_supprimer.onclick = function() {
        $.post("assets/php/delete_actupreview.php",
        {
          id_to_delete: obj.id
        },
        function(){
        window.location.replace("uploadactualite.php");
        });
      }


    });

    });
  }

  AddNewSection();

  function randomString(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * 
 charactersLength));
   }
   return result;
}


  </script>

</body>
</html>