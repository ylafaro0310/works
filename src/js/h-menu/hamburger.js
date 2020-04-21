const icon = document.getElementsByClassName("hamburger-icon")[0];
const menu = document.getElementsByClassName("hamburger-menu")[0];

icon.addEventListener("click",()=>{
    console.log("click");
    menu.classList.toggle("open");
});
