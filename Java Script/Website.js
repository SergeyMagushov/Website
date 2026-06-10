// Добавляем обработчики событий для кнопок
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation(); // Предотвращаем всплытие события
                alert('Вы нажали на кнопку!');
            });
        });
        
        // Добавляем возможность переворота по клику (для мобильных устройств)
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function() {
                // Проверяем, является ли устройство сенсорным
                if ('ontouchstart' in window || navigator.maxTouchPoints) {
                    this.querySelector('.card-inner').classList.toggle('flipped');
                }
            });
        });
        
        // Добавляем CSS класс для переворота по клику
        const style = document.createElement('style');
        style.textContent =` 
            .flipped {
                transform: rotateY(180deg) !important;
            }`
        ;
        document.head.appendChild(style);