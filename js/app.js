

const menuicon = document.querySelector('.menuicon');
const menu = document.querySelector('.menu');

const close = document.querySelector('.close');
const closemenu = document.querySelector('.closemenu');

const piece = document.querySelector('.piece');

const filtericon = document.querySelector('.filtericon');
const filter = document.querySelector('.filter');
const darkness = document.querySelector('.darkness');

const products = document.querySelectorAll('.product');

const closefilter = document.querySelector('.closefilter');

const topInfo = document.querySelector('.info');
const closetopinfo = document.querySelector('.closetopinfo');


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

    products.forEach(function (product) {
        product.classList.toggle('size');
    })
});

filtericon.addEventListener('click', function () {
    filter.classList.add('active');
});
darkness.addEventListener('click', function () {
    filter.classList.remove('active');
});


closefilter.addEventListener('click', function () {
    filter.classList.remove('active');
});
closetopinfo.addEventListener('click', function () {
    topInfo.style.display = 'none';
});