

const menuicon = document.querySelector('.menuicon');
const menu = document.querySelector('.menu');

const close = document.querySelector('.close');
const closemenu = document.querySelector('.closemenu');

const piece = document.querySelector('.piece');

const filtericon = document.querySelector('.filtericon');
const filter = document.querySelector('.filter');
const darkness = document.querySelector('.darkness');

menuicon.addEventListener('click', function () {
    menu.classList.add('active');

});
close.addEventListener('click', function () {
    menu.classList.remove('active');
});

closemenu.addEventListener('click', function () {
    menu.classList.remove('active');
});

piece.addEventListener('click', function () {
    piece.classList.toggle('close');
});

filtericon.addEventListener('click', function () {
    filter.classList.add('active');
});
darkness.addEventListener('click', function () {
    filter.classList.remove('active');
});