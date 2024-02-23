import './bootstrap';

import 'flowbite';

import Alpine from 'alpinejs';
import { initFlowbite } from 'flowbite';
import { Modal } from 'flowbite';

window.Alpine = Alpine;

Alpine.start();



document.addEventListener('livewire:navigated',()=>{
    console.log('navigated')
    initFlowbite();

})

const $targetEl  = document.getElementById('crud-modal');
window.addEventListener('close-modal',event=>{

    const modal = new Modal($targetEl);

    modal.hide();
});

// DarkMode start
const toggleBtn = document.getElementById("toggle-btn");
const darkToggle = document.getElementById("dark-toggle");
const theme = document.querySelector('html');
let darkMode = localStorage.getItem("dark-mode");

const enableDarkMode = () => {
    theme.classList.add("dark");
    toggleBtn.innerHTML = `<i id="dark-toggle" class="mr-2 text-white fas fa-sun"></i>`;
    localStorage.setItem("dark-mode", "enabled");
    console.log(darkToggle.classList)
};

const disableDarkMode = () => {
    theme.classList.remove("dark");
    toggleBtn.innerHTML = `<i id="dark-toggle" class="mr-2 fas fa-moon"></i>`
    localStorage.setItem("dark-mode", "disabled");
    console.log(darkToggle.classList)
};

if (darkMode === "enabled") {
    enableDarkMode();
}

toggleBtn.addEventListener("click", (e) => {
    darkMode = localStorage.getItem("dark-mode");
    if (darkMode === "disabled") {
        enableDarkMode();
    } else {
        disableDarkMode();
    }
});

// darkmode End

