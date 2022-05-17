<link rel="stylesheet" href="assets/css/navbar.css">
<div id="navbar">
<div id="navbar_top">
  <input id="navbar_searchinput" type="text" placeholder="Rechercher dans Augustine Métro..."  maxlength="50">
     <img class="navbarlogo search" src="assets/img/search.png"></img> </input>
  <img id="navbarimg" src="assets/img/logo.jpg"></img> 
   <div id="logoconainters">
     <a href="https://augustine-metro.fr/panier"><img class="navbarlogo" src="assets/img/panier.png"></img><!--Panier--></a>
     <a href="https://augustine-metro.fr/connexion"><img class="navbarlogo" src="assets/img/profile.png"></img><!--Profil--></a>
   </div>

    <div id = "burger"></div> 

</div>
<div id="navbar_bottom">
</div>

</div>

<div id="sous_categories_container"><div id="sous_categories"></div></div>

<script>

sous_categories_opened = false

class Categorie {
  constructor(name, souscategories, link) {
    this.name = name
    this.souscategories = souscategories
    this.link = link
  }
}

class SousCategorie{
  constructor(name, categories) {
    this.name = name
    this.categories = categories
  }
}

class CategorieLink{
    constructor(name, link) {
    this.name = name
    this.link = link
  }
}

navLinks = [

new Categorie("Garçons", [
    new SousCategorie("Vestes & ponchos",
            [new CategorieLink("Vestes", "https://augustine-metro.fr/17-pour-les-garcons"),
            new CategorieLink("Ponchos", "https://augustine-metro.fr/17-pour-les-garcons"),
            new CategorieLink("Les charkaps", "https://augustine-metro.fr/13-les-charkaps")]),

    new SousCategorie("Softshells",
            [new CategorieLink("Vestes coupe droite", "https://augustine-metro.fr/4-vestes-coupe-droite"),
            new CategorieLink("Vestes coupe évasée", "https://augustine-metro.fr/4-vestes-coupe-droite"),
            new CategorieLink("Ponchos-capes", "https://augustine-metro.fr/4-vestes-coupe-droite")])
], "https://augustine-metro.fr/17-pour-les-garcons"),

new Categorie("Filles", [
    new SousCategorie("Vestes & ponchos",
            [new CategorieLink("Vestes", "https://augustine-metro.fr/16-pour-les-filles"),
            new CategorieLink("Ponchos", "https://augustine-metro.fr/16-pour-les-filles"),
            new CategorieLink("Les charkaps", "https://augustine-metro.fr/13-les-charkaps")]),

    new SousCategorie("Softshells",
            [new CategorieLink("Vestes coupe droite", "https://augustine-metro.fr/4-vestes-coupe-droite"),
            new CategorieLink("Vestes coupe évasée", "https://augustine-metro.fr/4-vestes-coupe-droite"),
            new CategorieLink("Ponchos-capes", "https://augustine-metro.fr/4-vestes-coupe-droite")])
], "https://augustine-metro.fr/16-pour-les-filles"),

new Categorie("Adultes", [
    new SousCategorie("Vestes & ponchos",
            [new CategorieLink("Hommes", "https://augustine-metro.fr/22-hommes"),
            new CategorieLink("Femmes", "https://augustine-metro.fr/21-femmes")])
], "https://augustine-metro.fr/18-les-creations-pour-les-adultes"),

new Categorie("Vide atelier", [
    new SousCategorie("Vide atelier",
            [new CategorieLink("Voir le vide atelier", "https://augustine-metro.fr/12-vide-atelier")])
], "https://augustine-metro.fr/12-vide-atelier")

]

liContainerList = []
navLinks.forEach(function(element, index){


  liContainer = document.createElement("div");
  liContainer.className = "liContainer"
  liSelectLine = document.createElement("div");
  liSelectLine.className = "liSelectLine"

    li = document.createElement("li");
    li.innerText = element.name
    li.className = "linavbar"

    liContainer.appendChild(li)
    liContainer.appendChild(liSelectLine)
    document.getElementById("navbar_bottom").appendChild(liContainer)

    liContainerList.push(liContainer)

    liContainer.addEventListener('mouseenter', function(){
    clear_selected_bar()
     show_navList(index)
     if (sous_categories_opened == false){animate_open_sous_categories()}
     sous_categories_opened = true
     liContainerList[index].lastElementChild.style.opacity = 1
    });

    liContainer.addEventListener('click', function(){
    window.location.href = element.link
    });

});

function show_navList(index){

  if (sous_categories_opened){
      document.getElementById("sous_categories").style.transition = "max-height 0.9s, opacity 0s";
      document.getElementById("sous_categories").style.opacity = 0;
      document.getElementById("sous_categories").style.transition = "max-height 0.9s, opacity 0.25s";
      setTimeout(function(){
      document.getElementById("sous_categories").style.opacity = 1;
      }, 250);}else{document.getElementById("sous_categories").style.opacity = 1;}

  document.getElementById("sous_categories").innerHTML = ""
  let sousCategorie = navLinks[index].souscategories
  sousCategorie.forEach(function(element, id){

      div_souscategorie = document.createElement("div");
      div_souscategorie.className = "div_souscategorie"
      document.getElementById("sous_categories").appendChild(div_souscategorie)

      title = liContainer = document.createElement("p");
      title.innerText = element.name
      title.className = "souscategorieTitle"
      div_souscategorie.appendChild(title)

      element.categories.forEach(function(e){
      link = document.createElement("a");
      link.className = "souscategorieLink"
      link.innerText = e.name
      link.href = e.link
      div_souscategorie.appendChild(link)
      })
      
      div_souscategorie.style.paddingTop = "10px"
      div_souscategorie.style.paddingBottom = "30px"
  })
}

function empty_navList(){
      sous_categories_opened = false
      document.getElementById("sous_categories").style.transition = "max-height 0.3s, opacity 0.25s";
      document.getElementById("sous_categories").style.maxHeight = "0";
      div_souscategorie.style.paddingTop = "10px"
      div_souscategorie.style.paddingBottom = "30px"

      clear_selected_bar()
      //document.getElementById("sous_categories").style.opacity = 0;
}

document.getElementById("sous_categories").addEventListener('mouseleave', function(){
     empty_navList()
    });

    function animate_open_sous_categories(){
      document.getElementById("sous_categories").style.transition = "max-height 0.9s, opacity 0.25s";
      document.getElementById("sous_categories").style.maxHeight = "100vh";
    }

    function clear_selected_bar(){
      navLinks.forEach(function(element, index){
        liContainerList[index].lastElementChild.style.opacity = 0
      })
    }
    
    var buger_opened = false;

    set_burger_state();

    window.addEventListener('resize', function(){
      set_burger_state();
    })

    document.getElementById("burger").onclick = function(){
      buger_opened = !buger_opened;
      set_burger_state();
    }

    function set_burger_state(){
      if (window.innerWidth < 1200){
        if (buger_opened){
          document.getElementById("navbar_bottom").style.display = "flex"
      }else{
        close_burgermenu()
      }
      }else{
          document.getElementById("navbar_bottom").style.display = "flex"
      }

    }

    function close_burgermenu(){
          document.getElementById("navbar_bottom").style.display = "none"
    }


</script>