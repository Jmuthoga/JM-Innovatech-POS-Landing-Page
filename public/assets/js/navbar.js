document.addEventListener("DOMContentLoaded", function () {

    const dropdown = document.querySelector(".mega-dropdown");
    const menu = document.querySelector(".mega-menu");
    const trigger = dropdown.querySelector(".nav-link");

    let isOpen = false;

    trigger.addEventListener("click", function (e) {

        if (window.innerWidth <= 992) {

            e.preventDefault();

            isOpen = !isOpen;

            menu.style.display = isOpen ? "block" : "none";
        }
    });

    document.addEventListener("click", function (e) {

        if (!dropdown.contains(e.target)) {

            menu.style.display = "none";

            isOpen = false;
        }
    });

    window.addEventListener("resize", function () {

        if (window.innerWidth > 992) {

            menu.style.display = "";

            isOpen = false;
        }
    });

        /* ===============================
       HERO SLIDER (SAFE VERSION)
    =============================== */
    const slides = document.querySelectorAll(".slide");
    const nextBtn = document.querySelector(".slider-next");
    const prevBtn = document.querySelector(".slider-prev");

    if (slides.length > 0) {

        let current = 0;

        const showSlide = (index) => {
            slides.forEach(slide => {
                slide.classList.remove("active", "exit");
            });

            slides[current].classList.add("exit");
            current = index;
            slides[current].classList.add("active");
        };

        const nextSlide = () => {
            showSlide((current + 1) % slides.length);
        };

        const prevSlide = () => {
            showSlide((current - 1 + slides.length) % slides.length);
        };

        let timer = setInterval(nextSlide, 5000);

        nextBtn?.addEventListener("click", () => {
            clearInterval(timer);
            nextSlide();
            timer = setInterval(nextSlide, 5000);
        });

        prevBtn?.addEventListener("click", () => {
            clearInterval(timer);
            prevSlide();
            timer = setInterval(nextSlide, 5000);
        });
    }

});