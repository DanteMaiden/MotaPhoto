//script du menu mobile//
var menuBtn = document.getElementById("menuBtn");
var menuCroix = document.getElementById("menuCroix");
var megamenu = document.getElementById("megamenu");

menuBtn.addEventListener("click", function() {
    megamenu.classList.add("active");
    megamenu.classList.remove("inactive");
    menuCroix.classList.add("active");
    menuCroix.classList.remove("inactive");
    menuBtn.classList.remove("active");
    menuBtn.classList.add("inactive");
  });

  menuCroix.addEventListener("click", function() {
    megamenu.classList.add("inactive");
    megamenu.classList.remove("active");
    menuCroix.classList.add("inactive");
    menuCroix.classList.remove("active");
    menuBtn.classList.remove("inactive");
    menuBtn.classList.add("active");
  });

//script de la modale//
var contact = document.getElementsByClassName("menu-item-11");
var modale = document.getElementById("modale");
var overlay = document.getElementById("modale-overlay");

contact[0].addEventListener("click", function() {
    modale.classList.add("active");
    modale.classList.remove("inactive");
    overlay.classList.add("active");
    overlay.classList.remove("inactive");
  });

  contact[1].addEventListener("click", function() {
    modale.classList.add("active");
    modale.classList.remove("inactive");
    overlay.classList.add("active");
    overlay.classList.remove("inactive");
  });

  overlay.addEventListener("click", function() {
    modale.classList.add("inactive");
    modale.classList.remove("active");
    overlay.classList.add("inactive");
    overlay.classList.remove("active");
  });