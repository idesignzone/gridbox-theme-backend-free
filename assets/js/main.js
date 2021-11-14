/*
Template Name: Gridbox
Author: iDesignzone
*/

//===== Scroll totop
function stickyToTop() {
    var doc = document.documentElement;
    var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
    var stickyEl = document.getElementById('scroll-to-top');

    if (top > 1500) {
        stickyEl.classList.add('scroll-to-top');
    } else {
        stickyEl.classList.remove('scroll-to-top');
    }

}

document.addEventListener('DOMContentLoaded', function() {
    stickyToTop();
});

window.addEventListener('scroll', function() {
    stickyToTop();
});

//===== Prealoder
(function () {

    window.onload = function () {
        window.setTimeout(fadeout, 1);
    }

    function fadeout() {
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    }

})();
