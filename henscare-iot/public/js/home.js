// Smooth scrolling for internal links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
        });
    });
});

// Add intersection observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
        }
    });
}, observerOptions);

// Observe all cards for animation
document
    .querySelectorAll(".problem-card, .solution-card, .team-card")
    .forEach((card) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(30px)";
        card.style.transition = "all 0.6s ease";
        observer.observe(card);
    });

// Form submission handler
document.querySelectorAll(".instagram-link").forEach((link) => {
    link.addEventListener("mouseenter", function () {
        this.style.transform = "translateY(-3px) scale(1.05)";
    });

    link.addEventListener("mouseleave", function () {
        this.style.transform = "translateY(0) scale(1)";
    });
});
