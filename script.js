window.addEventListener("load", () =>{
    const loader = document.querySelector(".container");

    loader.classList.add("container-hidden");

    loader.addEventListener("transitionend", () =>{
        document.body.removeChild("loader");
    })
})

let navbar =  document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
}
window.onscroll = () =>{
    navbar.classList.remove('active');
}
