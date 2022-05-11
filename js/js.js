function fn_menu() {
    const menu = document.querySelector(".menu");
    menu.classList.toggle("menu-show");
}

window.onscroll = function() {
    if (document.documentElement.scrollTop > 30) {
        document.getElementById("header").style.padding = "10px 0";
        document.getElementById("header-logo").style.fontSize = "1.5rem";
        document.querySelector(".menu").style.top = "45px";
    } else {
        document.getElementById("header").style.padding = "20px 0";
        document.getElementById("header-logo").style.fontSize = "1.8rem";
        document.querySelector(".menu").style.top = "60px";
    }
}