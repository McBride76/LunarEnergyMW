document.addEventListener('DOMContentLoaded', () => {
    const loginIndicator = document.getElementById("jsLoginIndicator");
    
    // Review Modal
    const writeReviewBtn = document.getElementById("writeReviewBtn");
    const reviewModal = document.getElementById("reviewModal");
    const cancelBtn = document.getElementById("cancelReview");

    let stars = Array.from(document.getElementsByClassName("r-m-star"));

    writeReviewBtn.addEventListener("click", () => {
        reviewModal.classList.toggle("hidden");
    })

    //let hasReview = document.getElementsByClassName("your-review") != null ? true : false;
    const editReviewBtn = document.getElementById("editReview");

    if (loginIndicator.value == 1 && editReviewBtn) {
        editReviewBtn.addEventListener("click", () => {
            reviewModal.classList.toggle("hidden");
        })
    }

    cancelBtn.addEventListener("click", () => {
        if (loginIndicator.value == 1) {
            resetStars(stars);
            document.getElementById("hiddenStarCount").defaultValue = 1;
            document.getElementById("reviewBody").value = '';
        }
        
        reviewModal.classList.add("hidden");
    })
        
    stars.forEach(star => {
        star.addEventListener("click", e => {

            // Remove filled in style for all stars
            resetStars(stars);

            // Get count of stars
            let starNum = e.target.id[0];
            document.getElementById("hiddenStarCount").defaultValue = starNum;
            console.log(document.getElementById("hiddenStarCount"));

            // Change stars appearence
            for (i = 0; i < starNum; i++) {
                stars[i].classList.replace("fa-regular", "fa-solid");
            }

        })
    });

    // Reset star to default style
    function resetStars(starsP) {
        starsP.forEach(star => {
            if (star.classList.contains("fa-solid")) {
                star.classList.replace("fa-solid", "fa-regular");
            }
        })
    }
})