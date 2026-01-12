const supportModal = document.getElementById("supportModal");
const closeSupportBtn = document.getElementById("closeSupportModel");

// *! Open Support Modal when any support button is clicked
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".support-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            openSupportModal();
        });
    });
});

// *! Close Support Modal when close button is clicked
closeSupportBtn.addEventListener("click", closeSupportModal);


// *! Open Support Modal module
function openSupportModal() {
    document.getElementById("supportModal").style.display = "block";
    console.log("supportModal opened");
}

// *! Close Support Modal module
function closeSupportModal() {
    document.getElementById("supportModal").style.display = "none";
}

// *! Close Support Modal when user clicks outside of it
window.addEventListener("click", function (event) {
    if (event.target === supportModal) {
        closeSupportModal();
    }
});

// *! Close Support Modal when user presses the "Escape" key
document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeSupportModal();
    }
});
