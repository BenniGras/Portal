"use strict"

const icons = document.getElementsByClassName("card-arrow");

for(const icon of icons) {
    icon.style.cursor = "pointer";
    const cardBody = icon.parentElement.nextElementSibling;
    
    cardBody.classList.add("d-none");
    icon.classList.remove("fa-chevron-up");
    icon.classList.add("fa-chevron-down");

    icon.addEventListener("click", (e) => {

        cardBody.classList.toggle("d-none");

        if (cardBody.classList.contains("d-none")) {
            icon.classList.remove("fa-chevron-up");
            icon.classList.add("fa-chevron-down");
        } else {
            icon.classList.remove("fa-chevron-down");
            icon.classList.add("fa-chevron-up");
        }
    });
}

const select = document.getElementById("select-length");
select.classList.add("d-none");

const inputGallery = document.getElementById("input-gallery");
inputGallery.addEventListener("change", (e) => {
    select.classList.remove("d-none");
});

const inputTop = document.getElementById("input-top");
inputTop.addEventListener("change", (e) => {
    select.classList.remove("d-none");
});

const inputHighlight = document.getElementById("input-highlight");
inputHighlight.addEventListener("change", (e) => {
    select.classList.remove("d-none");
});

