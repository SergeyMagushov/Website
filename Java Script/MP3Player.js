document.addEventListener("DOMContentLoaded", function () {
    const player = document.getElementById('global-player');
    const titleDisplay = document.getElementById('current-track-title');
    const links = document.querySelectorAll('.track-link');

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const trackSrc = this.getAttribute('data-src');
            const trackTitle = this.innerText;

            player.src = trackSrc;
            titleDisplay.innerText = trackTitle;
            player.play();
        });
    });
});