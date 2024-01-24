document.addEventListener("DOMContentLoaded", () => {

    const slideOne = document.getElementById("slideOne");
    const slideTwo = document.getElementById("slideTwo");
    const slideThree = document.getElementById("slideThree");
    const slideFour = document.getElementById("slideFour");

    const scrollLeftBtn = document.getElementById("scrollLeftBtn");
    const scrollRightBtn = document.getElementById("scrollRightBtn");

    let slide = 1;

    scrollRightBtn.addEventListener("click", () => {
       if (slide != 4) {
            resetSlides();
            if (slide == 1) {
                slideTwo.classList.remove("hidden");
                scrollLeftBtn.classList.remove("nonvisible");
                scrollRightBtn.classList.remove("nonvisible");
            } else if (slide == 2) {
                slideThree.classList.remove("hidden");
                scrollLeftBtn.classList.remove("nonvisible");
                scrollRightBtn.classList.remove("nonvisible");
            } else {
                slideFour.classList.remove("hidden");
                scrollLeftBtn.classList.remove("nonvisible");
            }
            slide++;
       }
            
    })

    scrollLeftBtn.addEventListener("click", () => {
        if (slide != 1) {
            resetSlides();
            if (slide == 4) {
                slideThree.classList.remove("hidden");
                scrollLeftBtn.classList.remove("nonvisible");
                scrollRightBtn.classList.remove("nonvisible");
            } else if (slide == 3) {
                slideTwo.classList.remove("hidden");
                scrollRightBtn.classList.remove("nonvisible");
                scrollLeftBtn.classList.remove("nonvisible");
            } else {
                slideOne.classList.remove("hidden");
                scrollRightBtn.classList.remove("nonvisible");
            }
            slide--;
        }
    })

    function resetSlides() {
        slideOne.classList.add("hidden");
        slideTwo.classList.add("hidden");
        slideThree.classList.add("hidden");
        slideFour.classList.add("hidden");
        scrollLeftBtn.classList.add("nonvisible");
        scrollRightBtn.classList.add("nonvisible");
    }

})