document.addEventListener("DOMContentLoaded", () => {
    // Dropdowns
    const massagesDD = document.getElementById("massagesDD");
    const skinDD = document.getElementById("skinDD");
    const bundlesDD = document.getElementById("bundlesDD");

    // Sections
    const massages = document.getElementById("massages");
    const skinTreatments = document.getElementById("skinTreatments");
    const bundles = document.getElementById("bundles");

    massagesDD.addEventListener("click", () => {
        massages.classList.toggle("hidden");
    })

    skinDD.addEventListener("click", () => {
        skinTreatments.classList.toggle("hidden");
    })

    bundlesDD.addEventListener("click", () => {
        bundles.classList.toggle("hidden");
    })
})