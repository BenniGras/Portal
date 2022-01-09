"use strict"

const url = window.location.href;
const postUrl = url.slice(43);


const preI = postUrl.indexOf("dauer");
const pre = postUrl.slice(0,preI);

const postI = postUrl.indexOf("&id");
const post = postUrl.slice(postI)

console.log(pre + " " + post);

const select = document.getElementById('select');



select.addEventListener("change", () => {
    const duration = select.value;
    
    if(duration == 604800) {
        window.location.href = pre + "dauer=7" + post;
    }
    if(duration == 1209600) {
        window.location.href = pre + "dauer=14" + post;
    }
    if(duration == 1814400) {
        window.location.href = pre + "dauer=21" + post;
    }
    if(duration == 2419200) {
        window.location.href = pre + "dauer=28" + post;
    }
});
