require('./bootstrap');

// STICKY NAVIGATION

window.addEventListener('scroll', () => {
    const headerNavi = document.querySelector('.header__navigation-bottom');
  
    headerNavi.classList.toggle('sticky', window.scrollY > 100);

});

// For 

function myFunction() {
    document.getElementById("login-button").classList.add = "active";
}

function myFunction2() {
    document.getElementById("register-button").classList.add = "active";
}