setTimeout(function () {
    var window = document.getElementById('errorModal');
    if (window) {
        
        // Плавное сокрытие модального окна
        window.style.transition = 'opacity 0.5s ease';
        window.style.opacity = '0';

        // Удаление происходит только после окончания анимации сокрытия, поэтому время в этой функции (500), должно совпадать со временем анимации (500)
        setTimeout(function () {
            if (window) window.remove();
        }, 500);
    }
}, 3000); 