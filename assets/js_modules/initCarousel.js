const initCarousel = () => {
    const slidesContainer = document.querySelector('.all-slides');
    const dotsContainer = document.querySelector('.dots');
    const carouselData = JSON.parse(document.querySelector('#carousel-data').textContent);

    let currentSlideIndex = 0;

    // Populate the carousel with data
    const populateCarousel = () => {
        carouselData.forEach((audiobook, index) => {
            // Create slide
            const slide = document.createElement('div');
            slide.classList.add('one-slide');
            slide.style.display = (index === 0) ? 'block' : 'none'; // Show first slide initially

            const img = document.createElement('img');
            img.src = audiobook.imageName;
            img.alt = audiobook.title;

            slide.appendChild(img);
            slidesContainer.appendChild(slide);

            // Create dot
            const dot = document.createElement('div');
            dot.classList.add('one-dot');
            if (index === 0) dot.classList.add('active'); // Active dot for the first slide

            dotsContainer.appendChild(dot);
        });
    };

    // Function to show a specific slide
    const showSlide = (index) => {
        if (index >= slidesContainer.children.length) {
            currentSlideIndex = 0;
        } else if (index < 0) {
            currentSlideIndex = slidesContainer.children.length - 1;
        }

        [...slidesContainer.children].forEach(slide => slide.style.display = 'none');
        [...dotsContainer.children].forEach(dot => dot.classList.remove('active'));

        slidesContainer.children[currentSlideIndex].style.display = 'block';
        dotsContainer.children[currentSlideIndex].classList.add('active');
    };

    // Define nextSlide globally so that it's accessible for setInterval
    const nextSlide = () => {
        currentSlideIndex++;
        showSlide(currentSlideIndex);
    };

    // Navigate through slides
    const navigateSlide = () => {
        const prevSlide = () => {
            currentSlideIndex--;
            showSlide(currentSlideIndex);
        };

        [...dotsContainer.children].forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlideIndex = index;
                showSlide(currentSlideIndex);
            });
        });
    };

    populateCarousel();
    showSlide(currentSlideIndex);
    navigateSlide();

    // Automatically advance the carousel every 5 seconds (5000ms)
    setInterval(nextSlide, 5000); 
};

export { initCarousel };
