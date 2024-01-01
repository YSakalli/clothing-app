

const menuicon = document.querySelector('.menuicon');
const menu = document.querySelector('.menu');
const close = document.querySelector('.close');
const closemenu = document.querySelector('.closemenu');

menuicon.addEventListener('click', function () {
    menu.classList.add('active');

});
close.addEventListener('click', function () {
    menu.classList.remove('active');
});

closemenu.addEventListener('click', function () {
    menu.classList.remove('active');
});
