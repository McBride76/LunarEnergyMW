if (window.location.pathname.includes("contact.php")) {
    const textarea = document.getElementById("contactBody");
    const charDisplay = document.getElementById("charDisplay");
    
    textarea.value = '';
    
    textarea.addEventListener("keyup", (e) => {
        charDisplay.innerText = "Characters Remaining: " + (300 - textarea.value.length);
    })
}
