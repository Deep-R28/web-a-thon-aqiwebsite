let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');
menu.onclick = () => {
    menu.classList.togglw("bx-x");
    navbar.classList.toggle("active");
}

window.onscroll = () => {
    menu.classList.remove("bx-x");
    navbar.classList.remove("active");
}

const typed = new Typed('.multiple-text', {
    strings: ['Be Safe', 'Be Aware','Be Precautious','Stay Updated'],
    typeSpeed: 50,
    backSpeed: 60,
    backDelay: 1000,
    loop: true,
  });
