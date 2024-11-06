const iconMode = document.querySelector(".iconMode");

if (localStorage.getItem('dark-mode') === 'true') {
    document.body.classList.add('dark');
    iconMode.classList.add("active");
} else {
    document.body.classList.remove('dark');
    iconMode.classList.remove("active");
}

iconMode.addEventListener("click", () => {
    document.body.classList.toggle('dark');
    iconMode.classList.toggle("active");

    if (document.body.classList.contains('dark')) {
        localStorage.setItem('dark-mode', 'true');
    } else {
        localStorage.setItem('dark-mode', 'false');
    }
});
