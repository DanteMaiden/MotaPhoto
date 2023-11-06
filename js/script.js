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