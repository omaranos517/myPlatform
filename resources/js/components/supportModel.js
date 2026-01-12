const supportModal = document.getElementById("supportModal");
const closeSupportBtn = document.getElementById("closeSupportModel");

// *! Open Support Modal when button with data-action="open-support" is clicked
document.addEventListener("click", function (e) {
    const el = e.target.closest("[data-action]");
    if (!el) return;

    const action = el.dataset.action;

    if (action === "open-support") {
        openSupportModal();
    }

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
