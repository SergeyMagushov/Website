// Переменная count хранит число очков, текущую цену клика и текст сообщения при счете < 0
let count = 0; //Счетчик общего количества кликов
let currentCount = 1; //Счетчик прибавки при ручном нажатии 
let currentCount1 = 1; //Счетчик авто-прибавки
let totalAutoCursors = 0; // Счетчик общего количества купленных автоматических курсоров
let achievedMilestones = []; //Переменная для отслеживания промежуточных результатов для работы функционала достижений (ачивок)
let nextMilestone = 100;  

// Связываемв которые надо выводить новые данные - это сообщения о текущем счете, прибавки при ручном и автокликах и счет > или < 0
const scoreDisplay = document.getElementById('score'); // Вывод информации об общем количестве нажатий
const scoreDisplay1 = document.getElementById('score1'); // Вывод информации в счетчик стоимости ручного клика
const scoreDisplay2 = document.getElementById('score2'); // Вывод информации в счетчик стоимости авто-клика
const error = document.getElementById('attention');


// Поиск кнопки клика по id и присвоение ей значения
const button = document.getElementById('button');
// Поиск кнопки улучшения по id и присвоение ей значения
const button1 = document.getElementById('button1');
const button2 = document.getElementById('button2');
const button3 = document.getElementById('button3');
const button4 = document.getElementById('button4');
const button5 = document.getElementById('button5');
const button6 = document.getElementById('button6');
const button7 = document.getElementById('button7');
const button8 = document.getElementById('button8');
// Поиск кнопки автоклика по id и присвоение ей значения
const button9 = document.getElementById('button9');
const button10 = document.getElementById('button10');
const button11 = document.getElementById('button11');
const button12 = document.getElementById('button12');


// Функция для отображения автокликов раз в секунду
setInterval(() => {
    // Увеличиваем счетчик кликов на текущее значение количества автокликов
    count = count + currentCount1;

    // Записываем получившееся значение в экран счетчика количества кликов
    scoreDisplay.innerText = count;

    // Проверяем, выполнено ли условие достижения во время автоклика
    checkAndShowMilestone(count);

    // Получение координат основной кнопки клика
    const rect = button.getBoundingClientRect();

    // Координаты центра основной кнопки клика с учетом прокрутки страницы
    const clickX = rect.left + window.scrollX + (rect.width / 2);
    const clickY = rect.top + window.scrollY + (rect.height / 2);

    // Случайный разброс вылетающих цифр в пределах 15 пикселей
    const randomX = clickX + (Math.random() * 30 - 15);
    const randomY = clickY + (Math.random() * 30 - 15);

    // Передаем текущее значение количества автокликов в вылетающие цифры по координатам кнопки клика
    createFloatingNumber(randomX, randomY, `+${currentCount1}`, '#00ab4a');

    // Если куплено хотя бы одно автоматическое улучшение (значение авто-клика больше стартового 1)
    if (currentCount1 > 1) {
        // Вызываем визуальное появление курсоров вокруг главного печенья каждую секунду при авто-клике
        // Количество отображаемых курсоров за один такт зависит от силы вашего автоклика
        spawnCursorsAroundCookie(currentCount1);
    }
}, 1000);


// Назначаем "слушатель событий" на кнопку
// Первый аргумент 'click' — тип события (нажатие мыши)
// Второй аргумент — функция, которая сработает в момент клика
// (Добавили аргумент event, чтобы передавать координаты клика для вылетающих цифр)
button.addEventListener('click', (event) => {

    // При каждом клике прибавляем текущую стоимость клика к переменной count (вместо фиксированного +1)
    count = count + currentCount;

    // Берем элемент scoreDisplay и записываем в него новое значение count
    // innerText меняет только текст внутри тега <span>
    scoreDisplay.innerText = count;

    // Проверяем, выполнено ли условие достижения во время автоклика
    checkAndShowMilestone(count);

    // Функция, которая создает вылетающую зеленую цифру в месте клика мыши
    createFloatingNumber(event.clientX, event.clientY, `+${currentCount}`, '#00ab4a');
});


// Прописываем логику улучшения при нажатии на кнопку улучшения 1 (значение button1)
button1.addEventListener('click', (event) => {
    // ЗАЩИТА ОТ МИНУСА: проверяем, достаточно ли у игрока очков для покупки улучшения за 20 единиц
    if (count >= 20) {
        // При покупке улчешния у счетчика count списывается 20 единиц, так как улучшение стоит 20 единиц. Также записывается новая стоимость клика (клик +1)
        count = count - 20;
        currentCount = currentCount + 1;

        // Берем элемент scoreDisplay и записываем в него новое значение count. Так же меняем значение стоимости одного клика ScoreDisplay1
        // innerText меняет только текст внутри тега <span>
        scoreDisplay.innerText = count;
        scoreDisplay1.innerText = currentCount;

        // Функция, которая создает вылетающую красную цифру стоимости при покупке улучшения
        createFloatingNumber(event.clientX, event.clientY, `-20`);

        //Очищаем сообщение "Недостаточно ресурсов" при следующей покупке апгрейда
        error.innerText = "";
    } else {
        // Если очков меньше 20 - выводится предупреждение, что ресурсов недостаточно
        // error.innerText = "Недостаточно ресурсов для улучшения"; - изначальный способ, сообщение выводится под основным печеньем
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку улучшения 2 (значение button2)
button2.addEventListener('click', (event) => {
    if (count >= 40) {
        count = count - 40;
        currentCount = currentCount + 2;

        scoreDisplay.innerText = count;
        scoreDisplay1.innerText = currentCount;

        createFloatingNumber(event.clientX, event.clientY, `-40`);

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку улучшения 3 (значение button3)
button3.addEventListener('click', (event) => {
    if (count >= 80) {
        count = count - 80;
        currentCount = currentCount + 4;

        scoreDisplay.innerText = count;
        scoreDisplay1.innerText = currentCount;

        createFloatingNumber(event.clientX, event.clientY, `-80`);

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку улучшения 4 (значение button4)
button4.addEventListener('click', (event) => {
    if (count >= 160) {
        count = count - 160;
        currentCount = currentCount + 8;

        scoreDisplay.innerText = count;
        scoreDisplay1.innerText = currentCount;

        createFloatingNumber(event.clientX, event.clientY, `-160`);

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку улучшения 5 (значение button5)
button5.addEventListener('click', (event) => {
    if (count >= 320) {
        count = count - 320;
        currentCount = currentCount + 16;

        scoreDisplay.innerText = count;
        scoreDisplay1.innerText = currentCount;

        createFloatingNumber(event.clientX, event.clientY, `-320`);

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку улучшения 6 (значение button6)
button6.addEventListener('click', (event) => {
    if (count >= 640) {
        count = count - 640;
        currentCount = currentCount + 32;

        scoreDisplay.innerText = count;
        scoreDisplay1.innerText = currentCount;

        createFloatingNumber(event.clientX, event.clientY, `-640`);

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку улучшения 7 (значение button7)
button7.addEventListener('click', (event) => {
    if (count >= 1280) {
        count = count - 1280;
        currentCount = currentCount + 64;

        scoreDisplay.innerText = count;
        scoreDisplay1.innerText = currentCount;

        createFloatingNumber(event.clientX, event.clientY, `-1280`);

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку улучшения 8 (значение button8)
button8.addEventListener('click', (event) => {
    if (count >= 2560) {
        count = count - 2560;
        currentCount = currentCount + 128;

        scoreDisplay.innerText = count;
        scoreDisplay1.innerText = currentCount;

        createFloatingNumber(event.clientX, event.clientY, `-2560`);

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку автоматического клика 1 (значение button9)
button9.addEventListener('click', (event) => {
    if (count >= 200) {
        count = count - 200;
        currentCount1 = currentCount1 + 1;

        scoreDisplay.innerText = count;
        scoreDisplay2.innerText = currentCount1;

        createFloatingNumber(event.clientX, event.clientY, `-200`);

        // Увеличиваем общее число постоянных курсоров на 1 и перерисовываем окантовку вокруг печенья
        totalAutoCursors = totalAutoCursors + 1;
        spawnCursorsAroundCookie();

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку автоматического клика 2 (значение button10)
button10.addEventListener('click', (event) => {
    if (count >= 400) {
        count = count - 400;
        currentCount1 = currentCount1 + 2;

        scoreDisplay.innerText = count;
        scoreDisplay2.innerText = currentCount1;

        createFloatingNumber(event.clientX, event.clientY, `-400`);

        // Увеличиваем общее число постоянных курсоров на 2 и перерисовываем окантовку вокруг печенья
        totalAutoCursors = totalAutoCursors + 2;
        spawnCursorsAroundCookie();

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку автоматического клика 3 (значение button11)
button11.addEventListener('click', (event) => {
    if (count >= 800) {
        count = count - 800;
        currentCount1 = currentCount1 + 4;

        scoreDisplay.innerText = count;
        scoreDisplay2.innerText = currentCount1;

        createFloatingNumber(event.clientX, event.clientY, `-800`);

        // Увеличиваем общее число постоянных курсоров на 4 и перерисовываем окантовку вокруг печенья
        totalAutoCursors = totalAutoCursors + 4;
        spawnCursorsAroundCookie();

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Прописываем логику улучшения при нажатии на кнопку автоматического клика 4 (значение button12)
button12.addEventListener('click', (event) => {
    if (count >= 1600) {
        count = count - 1600;
        currentCount1 = currentCount1 + 8;

        scoreDisplay.innerText = count;
        scoreDisplay2.innerText = currentCount1;

        createFloatingNumber(event.clientX, event.clientY, `-1600`);

        // Увеличиваем общее число постоянных курсоров на 8 и перерисовываем окантовку вокруг печенья
        totalAutoCursors = totalAutoCursors + 8;
        spawnCursorsAroundCookie();

        error.innerText = "";
    } else {
        // error.innerText = "Недостаточно ресурсов для улучшения";
        createFloatingNumber(event.clientX, event.clientY, "Недостаточно ресурсов для улучшения");
    }
});

// Функция для создания эффекта вылетающих цифр на экране
function createFloatingNumber(x, y, text, color) {
    // Создаем виртуальный тег div для цифры
    const floatingDiv = document.createElement('div');

    // Присваиваем ему класс анимации, который мы написали в CSS
    floatingDiv.className = 'floating-number';

    // Записываем внутрь текст (например, +1 или -20)
    floatingDiv.innerText = text;

    // Окрашиваем текст в нужный цвет (зеленый или красный)
    floatingDiv.style.color = color;

    // Устанавливаем координаты появления ровно там, куда кликнул курсор мыши
    floatingDiv.style.left = x + 'px';
    floatingDiv.style.top = y + 'px';

    // Добавляем созданный элемент в самый конец тега body на страницу
    document.body.appendChild(floatingDiv);

    // Через 800 миллисекунд (когда анимация полностью завершится) удаляем элемент, чтобы не нагружать память
    setTimeout(() => {
        floatingDiv.remove();
    }, 800);
}

function updateHiddenField() {
    // 1. Находим тег span, где отображается текущий счет
    const scoreSpan = document.getElementById('score');    
    // 2. Находим скрытое поле input
    const scoreInput = document.getElementById('hidden_score');    
    // 3. Копируем текст из span в значение скрытого поля
    scoreInput.value = scoreSpan.innerText;
}

// Функция для вывода сообщения о достижении определенного количества счета (достижение)
function checkAndShowMilestone(currentScore) {
    
    // Если текущий счет игрока достиг или превысил запланированный порог
    if (currentScore >= nextMilestone && !achievedMilestones.includes(nextMilestone)) {        
        // Запоминаем текущее достигнутое число очков
        let currentMilestone = nextMilestone;
        
        // Сохраняем уже достигнутое количество очков, чтобы не было повторов
        achievedMilestones.push(currentMilestone);

        // Увеличиваем следующий порог в 2 раза для будущего достижения (100 -> 200 -> 400 -> 800)
        nextMilestone = nextMilestone * 2;

        const milestoneDiv = document.createElement('div'); // Создаем виртуальный тег div для текста достижения        
        milestoneDiv.className = 'milestone-achievement'; // Присваиваем ему специальный класс анимации, который мы написали в CSS        
        milestoneDiv.innerText = `Вау, ты крутая шкила ! ${currentMilestone} ОЧКОВ!`; // Текст оповещения 
        
        const rect = button.getBoundingClientRect();// Получение координат основной кнопки клика (печенья)        
        const cookieX = rect.left + window.scrollX + (rect.width / 2); // Координаты центра печенья 
        const cookieY = rect.top + window.scrollY + (rect.height / 2) - 20; // Смещаем координату Y выше центра печенья, чтобы текст был выше
        // Появление оповещения прямо над печеньем
        milestoneDiv.style.left = cookieX + 'px';
        milestoneDiv.style.top = cookieY + 'px';
        
        document.body.appendChild(milestoneDiv); // Добавление созданного элемента на страницу

        // Через 1500 миллисекунд (когда золотая анимация полностью завершится) удаляем элемент из памяти
        setTimeout(() => {
            milestoneDiv.remove();
        }, 1500);
    }
}

// Функция для создания значков мыши (курсоров), которые стабильно висят рядами вокруг печенья
function spawnCursorsAroundCookie() {
    // Проверяем, существует ли на странице главная кнопка печенья
    if (!button) return;

    // Сначала удаляем все старые статичные курсоры перед тем, как перерисовать обновленные ряды
    const oldCursors = button.querySelectorAll('.cursor-icon');
    oldCursors.forEach(cur => cur.remove());
    
    // Сколько курсоров максимально помещается в самый первый (внутренний) ряд окружности
    const maxInFirstRow = 20; 

    // Цикл идет по каждому купленному курсору из переменной totalAutoCursors
    for (let i = 0; i < totalAutoCursors; i++) {
        
        // Определяем, на каком ряду (кольце) должен стоять текущий курсор
        const rowNumber = Math.floor(i / maxInFirstRow);
        
        // Порядковый номер курсора внутри его текущего ряда
        const indexInRow = i % maxInFirstRow;
        
        // Базовый радиус (половина ширины печенья минус 5px), каждый следующий ряд отодвигается еще на 18px
        const currentRadius = (button.offsetWidth / 2) - 5 + (rowNumber * 18); 

        // Вычисляем смещение для шахматного порядка: каждый нечетный ряд сдвигается на половину шага курсора
        // (360 градусов / 20 курсоров / 2 = 9 градусов смещения для чередования рядов)
        const rowShift = (rowNumber % 2 === 1) ? (360 / maxInFirstRow / 2) : 0;

        // Распределяем курсоры строго по цепочке друг за другом вокруг печенья с учетом шахматного смещения ряда
        const angleDegrees = ((indexInRow / maxInFirstRow) * 360) + rowShift;
        
        // Создаем новый постоянный элемент div для отображения курсора мыши
        const cursorDiv = document.createElement('div');
        
        // Назначаем класс стилей, который мы прописали в CSS файле
        cursorDiv.className = 'cursor-icon';
        
        // Передаем точный угол и радиус в CSS переменные для идеального позиционирования от центра печенья
        cursorDiv.style.setProperty('--angle', `${angleDegrees}deg`);
        cursorDiv.style.setProperty('--radius', `-${currentRadius}px`);
        
        // Добавляем созданную иконку курсора прямо внутрь главной кнопки печенья
        button.appendChild(cursorDiv);
    }
}

