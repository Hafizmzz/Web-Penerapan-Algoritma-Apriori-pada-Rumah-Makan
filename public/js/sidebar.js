// sidebar
const sidebar = document.getElementById("sidebar");
const content = document.getElementById("content");
const hoverZone = document.getElementById("hover-zone");

// Tampilkan sidebar dan geser konten
hoverZone.addEventListener("mouseenter", () => {
    sidebar.classList.remove("-translate-x-full");
    content.style.marginLeft = "16rem"; // Geser konten sesuai lebar sidebar (16rem = 64px x 4)
});

// Sembunyikan sidebar dan reset konten
sidebar.addEventListener("mouseleave", () => {
    sidebar.classList.add("-translate-x-full");
    content.style.marginLeft = "0";
});