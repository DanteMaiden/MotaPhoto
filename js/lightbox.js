let lightbox = document.getElementById("lightbox");
let photo = document.getElementById("photo-lightbox");
let lightbox_overlay = document.getElementById("lightbox-overlay");
let lightbox_cross = document.getElementById("lightbox-cross");
let lightbox_infos = document.getElementById("lightbox-infos");


photo.addEventListener("click", function() {
    lightbox.classList.add("active-flex");
    lightbox.classList.remove("inactive");
    lightbox_overlay.classList.add("active");
    lightbox_overlay.classList.remove("inactive");
    lightbox_cross.classList.add("active");
    lightbox_cross.classList.remove("inactive");
    lightbox_infos.classList.add("active-flex");
    lightbox_infos.classList.remove("inactive");
});

lightbox_cross.addEventListener("click", function() {
    lightbox.classList.add("inactive");
    lightbox.classList.remove("active-flex");
    lightbox_overlay.classList.add("inactive");
    lightbox_overlay.classList.remove("active");
    lightbox_cross.classList.add("inactive");
    lightbox_cross.classList.remove("active");
    lightbox_infos.classList.add("inactive");
    lightbox_infos.classList.remove("active-flex");
});
