// Создаем функцию для инициализации слайдера с параметрами
function createSlider(sliderId) {
    const slides = document.querySelectorAll(`#${sliderId} .slide`);
    const prevBtn = document.getElementById(`prevBtn${sliderId.slice(-1)}`);
    const nextBtn = document.getElementById(`nextBtn${sliderId.slice(-1)}`);
    const dotsContainer = document.getElementById(`dotsContainer${sliderId.slice(-1)}`);

    let currentSlide = 0;

    function initDots() {
        // Очищаем контейнер точек перед созданием новых
        dotsContainer.innerHTML = '';
        
        for (let i = 0; i < slides.length; i++) {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (i === currentSlide) {
                dot.classList.add('active');
            }

            dot.addEventListener('click', function () {
                goToSlide(i);
            });

            dotsContainer.appendChild(dot);
        }
    }

    function goToSlide(slideIndex) {
        // Скрываем все слайды этого слайдера
        slides.forEach(slide => {
            slide.classList.remove('active');
        });

        // Убираем активность у всех точек этого слайдера
        const dots = dotsContainer.querySelectorAll('.dot');
        dots.forEach(dot => {
            dot.classList.remove('active');
        });

        // Показываем выбранный слайд
        slides[slideIndex].classList.add('active');
        dots[slideIndex].classList.add('active');

        currentSlide = slideIndex;
    }

    function nextSlide() {
        let nextIndex = currentSlide + 1;

        if (nextIndex >= slides.length) {
            nextIndex = 0;
        }

        goToSlide(nextIndex);
    }

    function prevSlide() {
        let prevIndex = currentSlide - 1;

        if (prevIndex < 0) {
            prevIndex = slides.length - 1;
        }

        goToSlide(prevIndex);
    }

    // Назначаем обработчики событий
    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);

    function startAutoSlide() {
        setInterval(nextSlide, 15000);
    }

    function initSlider() {
        initDots();
        startAutoSlide();
    }

    // Инициализируем слайдер
    initSlider();
}

// Инициализируем все четыре слайдера при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    createSlider('slider1');
    createSlider('slider2');
    createSlider('slider3');
    createSlider('slider4');
});