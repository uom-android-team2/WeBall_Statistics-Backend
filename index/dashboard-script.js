"use strict";

const popup = document.querySelector(".popup");
const overlay = document.querySelector(".overlay");
const btnClosePopup = document.querySelector(".close-popup");
const btnOpenPopup = document.querySelector(".show-popup");

const openPopup = function () {
  popup.classList.remove("hidden");
  overlay.classList.remove("hidden");
};

const closePopup = function () {
  popup.classList.add("hidden");
  overlay.classList.add("hidden");
};

btnOpenPopup.addEventListener("click", openPopup);

btnClosePopup.addEventListener("click", closePopup);

overlay.addEventListener("click", closePopup);

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape" && !popup.classList.contains("hidden")) {
    closePopup();
  }
});
