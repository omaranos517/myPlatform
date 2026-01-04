const backBtn = document.getElementById("back-btn");

function goBack() {
    const lastPage = sessionStorage.getItem("lastPage");

    if (window.history.length > 1) {
        window.history.back();
    } else if (lastPage && lastPage !== window.location.href) {
        window.location.href = lastPage;
    } else {
        window.location.href = window.homeRoute; // fallback أخير
    }

    console.log("Go back function works");
}

if (backBtn) {
    backBtn.addEventListener("click", goBack);
}
