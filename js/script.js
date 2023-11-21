//script du menu mobile//
const menuBtn = document.getElementById("menuBtn");
const menuCroix = document.getElementById("menuCroix");
const megamenu = document.getElementById("megamenu");

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
const contacts = document.querySelectorAll(".menu-item-11");
const modale = document.getElementById("modale");
const overlay = document.getElementById("modale-overlay");
const reference = document.getElementsByClassName("form_ref");

// Bouton contact sur la page de photos
const photo_btn_contact = document.getElementById("photo-btn-contact");

contacts.forEach(contact => {
  contact.addEventListener("click", () => {
    modale.classList.add("active");
    modale.classList.remove("inactive");
    overlay.classList.add("active");
    overlay.classList.remove("inactive");
  })
})


// contact[0].addEventListener("click", function() {
//     modale.classList.add("active");
//     modale.classList.remove("inactive");
//     overlay.classList.add("active");
//     overlay.classList.remove("inactive");
//   });

//   contact[1].addEventListener("click", function() {
//     modale.classList.add("active");
//     modale.classList.remove("inactive");
//     overlay.classList.add("active");
//     overlay.classList.remove("inactive");
//   });

  photo_btn_contact?.addEventListener("click", function() {
    modale.classList.add("active");
    modale.classList.remove("inactive");
    overlay.classList.add("active");
    overlay.classList.remove("inactive");
    reference[0].value = ref;
  });

  overlay.addEventListener("click", function() {
    modale.classList.add("inactive");
    modale.classList.remove("active");
    overlay.classList.add("inactive");
    overlay.classList.remove("active");
  });