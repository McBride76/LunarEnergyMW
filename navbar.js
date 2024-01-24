const linkHome = document.getElementById('linkHome');
const linkServices = document.getElementById('linkServices');
const linkBook = document.getElementById('linkBook');
const linkLoginRegister = document.getElementById('linkLoginRegister');
const linkLogout = document.getElementById("linkLogout");
const linkUsers = document.getElementById("linkUsers");
const linkAppointments = document.getElementById("linkAppointments");

const loginIndicator = document.getElementById("jsLoginIndicator");

linkHome.classList.remove('current');

console.log(loginIndicator.value)

if (loginIndicator.value == 0 || loginIndicator.value == 1) {
    linkServices.classList.remove('current');
    linkBook.classList.remove('current');
    if (loginIndicator == 0) {
        linkLoginRegister.classList.remove('current');
    }
}

if (loginIndicator.value == 2) {
    linkUsers.classList.remove('current');
    linkAppointments.classList.remove('current');
}

if (window.location.href.includes("services.php")) {
    linkServices.classList.add('current');
} else if (window.location.href.includes("index.php")) {
    linkHome.classList.add('current');
} else if (window.location.href.includes("book")) {
    linkBook.classList.add('current');
} else if (window.location.href.includes("login.php") || document.URL.includes("register.php")) {
    linkLoginRegister.classList.add('current');
} else if (window.location.href.includes('users')) {
    linkUsers.classList.add('current');
} else if (window.location.href.includes('appointments')) {
    linkAppointments.classList.add('current');
}