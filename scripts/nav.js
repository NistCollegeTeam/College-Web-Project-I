const title = document.querySelector(".nav-title");
const menu = document.querySelector(".nav-links");
title.addEventListener("click", function () {
  const display = menu.style.display;
  if (display == "flex") {
    menu.style.display = "none";
  } else {
    menu.style.display = "flex";
  }
});

var window_width = window.matchMedia("(min-width: 760px)");
function restoreNav(window_width) {
  if (window_width.matches) {
    // If media query matches
    menu.style.display = "flex";
  }
}
window_width.addListener(restoreNav); // Attach listener function on state changes
