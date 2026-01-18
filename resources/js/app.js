import "./bootstrap";
import "./components/flashMessage";
import "./components/loadingScreen";
import "./components/header";
import "./components/footer";
import "./components/supportModel";

const app = document.getElementById("app");

const serverDarkMode = app?.dataset.darkMode === "1";