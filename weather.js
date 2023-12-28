document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const weatherInfo = document.getElementById('weather-info');
    const weatherContainer = document.querySelector('.weather-container');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const city = document.querySelector('input[name="city"]').value;
        if (city) {
            const api_key = "33b8f8f30f2059af078e4e8d67a65785";
            const api_url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${api_key}`;

            fetch(api_url)
                .then(response => response.json())
                .then(data => {
                    // Extract weather information from the API response
                    let condition = data.weather[0].main;
                    let backgroundImage = '';
                    // Select images based on condition
                    switch (condition.toLowerCase()) {
                        case 'clouds': backgroundImage = 'cloudy.jpeg'; break;
                        case 'rain': backgroundImage = 'rainy.jpeg'; break;
                        case 'snow': backgroundImage = 'snowy.jpg'; break;
                        case 'clear': backgroundImage = 'sunny.jpeg'; break;
                        default: backgroundImage = 'default.jpeg';
                    }
                    weatherContainer.style.backgroundImage = `url('${backgroundImage}')`;
                    const main = data.weather[0].main;
                    const temperature = data.main.temp;
                    const humidity = data.main.humidity;
                    const pressure = data.main.pressure;

                    // Create HTML for weather information
                    const weatherHtml = `
                        <p>Weather in ${city}</p>
                        <p>Main: ${main}</p>
                        <p>Temperature: ${temperature}K</p>
                        <p>Humidity: ${humidity}%</p>
                        <p>Pressure: ${pressure}hPa</p>
                    `;

                    // Update the weather container with the information
                    weatherInfo.innerHTML = weatherHtml;

                })
                .catch(error => {
                    weatherInfo.innerHTML = "Error fetching weather data. Please try again.";
                });
        }
        else {
            const weatherhtml = '<p>Enter the city name</p>';
            weatherInfo.innerHTML = weatherhtml;
        }
    });
});






