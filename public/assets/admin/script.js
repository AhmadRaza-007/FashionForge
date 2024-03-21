const mobileScreen = window.matchMedia("(max-width: 990px )");
$(document).ready(function () {
    $(".dashboard-nav-dropdown-toggle").click(function () {
        $(this).closest(".dashboard-nav-dropdown")
            .toggleClass("show")
            .find(".dashboard-nav-dropdown")
            .removeClass("show");
        $(this).parent()
            .siblings()
            .removeClass("show");
    });
    $(".menu-toggle").click(function () {
        if (mobileScreen.matches) {
            $(".dashboard-nav").toggleClass("mobile-show");
        } else {
            $(".dashboard").toggleClass("dashboard-compact");
        }
    });
});



// Select Body
// const bodyEle = document.body;

// // Select Switch Toggle
// const switchToggle = document.querySelector('#toggle-switch');

// // When (switchToggle) has (click) Event
// switchToggle.addEventListener('click', function () {
//     console.log('clicked');
//     bodyEle.classList.toggle('body_theme_light'); // Use toggle instead of add
// });

toggleTheme()
function toggleTheme() {
    const is_true = document.getElementById('switchCeckbox');
    if (is_true.checked) {
        document.body.classList.add('body_theme_light'); // Use toggle instead of add
    } else {
        document.body.classList.remove('body_theme_light');
    }
}

// :)
