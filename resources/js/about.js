
// Fade in about section and paragraphs
document.addEventListener("DOMContentLoaded", function () {
    const aboutSection = document.getElementById("aboutSection");
    const textElements = aboutSection.querySelectorAll("p");

    // Intersection Observer for slide-up effect
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                aboutSection.classList.remove("opacity-0", "translate-y-10");
                aboutSection.classList.add("opacity-100", "translate-y-0");

                // Fade in paragraphs with delay
                textElements.forEach((p, index) => {
                    setTimeout(() => {
                        p.classList.remove("opacity-0");
                        p.classList.add("opacity-100");
                    }, index * 300); // Delay increases for each paragraph
                });
            }
        });
    }, { threshold: 0.2 });

    observer.observe(aboutSection);
});