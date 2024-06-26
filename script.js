    // Skrypt do aktualizacji daty i czasu
    function updateTime() {
        const now = new Date();
        const days = ['niedziela', 'poniedziałek', 'wtorek', 'środa', 'czwartek', 'piątek', 'sobota'];
        const months = ['styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień'];

        const dayName = days[now.getDay()];
        const monthName = months[now.getMonth()];
        const date = now.getDate();
        const year = now.getFullYear();
        const hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');

        const timeString = `${dayName}, ${date} ${monthName} ${year}, ${hours}:${minutes}:${seconds}`;

        document.getElementById('current-time').textContent = timeString;
    }

    setInterval(updateTime, 1000);
    updateTime();


    // SLIDER

    let slideIndex = 0;

    function showSlides() {
        let slides = document.querySelectorAll('.gallery img');
        slides.forEach((slide, index) => {
            slide.style.display = (index === slideIndex) ? 'block' : 'none';
        });
    }

    function nextSlide() {
        let slides = document.querySelectorAll('.gallery img');
        slideIndex = (slideIndex + 1) % slides.length;
        showSlides();
    }

    function previousSlide() {
        let slides = document.querySelectorAll('.gallery img');
        slideIndex = (slideIndex - 1 + slides.length) % slides.length;
        showSlides();
    }

    document.getElementById('nextButton').addEventListener('click', nextSlide);
    document.getElementById('prevButton').addEventListener('click', previousSlide);

    // Initial display
    showSlides();


// BMI

    function calculateBMI() {
        const height = parseFloat(document.getElementById('height').value) / 100; // Zamiana na metry
        const weight = parseFloat(document.getElementById('weight').value);

        if (isNaN(height) || isNaN(weight) || weight < 0 || height < 0) {
            alert("Proszę podać prawidłowe wartości.");
            return;
        }

        const bmi = weight / (height * height);
        const bmiResult = document.getElementById('bmiResult');

        bmiResult.textContent = `Twoje BMI wynosi: ${bmi.toFixed(2)}`;
    }
