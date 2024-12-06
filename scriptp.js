// Coordinates of top cities
const cityCoordinates = {
    "Salem": { lat: 11.6643, lon: 78.1460 },
    "Vellore": { lat: 12.9165, lon: 79.1320 },
    "Chennai": { lat: 13.0827, lon: 80.2707 },
    "Bangalore": { lat: 12.9716, lon: 77.5946 },
    "Delhi": { lat: 28.6139, lon: 77.2090 }
};

const topCities = ["Salem", "Vellore", "Chennai", "Bangalore", "Delhi"];

// Function to fetch AQI data for the selected city
function getWeatherAndAQIData() {
    const city = document.getElementById("citySelect").value;
    const apiKey = '49bcd6ab5212e1c6b9f3d6064f58f996'; // Replace with your OpenWeatherMap API key
    const weatherUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;
    const { lat, lon } = cityCoordinates[city];
    const aqiUrl = `https://api.openweathermap.org/data/2.5/air_pollution?lat=${lat}&lon=${lon}&appid=${apiKey}`;

    // Fetching weather data
    fetch(weatherUrl)
        .then(response => response.json())
        .then(data => {
            const weatherInfo = `
                <strong>Weather Information:</strong><br>
                Temperature: ${data.main.temp}°C<br>
                Humidity: ${data.main.humidity}%<br>
                Wind Speed: ${data.wind.speed} m/s<br>
                Weather: ${data.weather[0].description}
            `;
            document.getElementById("weatherInfo").innerHTML = weatherInfo;
        })
        .catch(error => {
            console.error("Error fetching weather data: ", error);
            document.getElementById("weatherInfo").innerHTML = "Failed to fetch weather data.";
        });

    // Fetching AQI data for the selected city
    fetch(aqiUrl)
        .then(response => response.json())
        .then(data => {
            const aqi = data.list[0].main.aqi;
            const aqiStatus = getAQIStatus(aqi);
            document.getElementById("aqiLevel").innerText = aqi;
            document.getElementById("aqiStatus").innerText = `Air Quality: ${aqiStatus}`;
            updateAQIRadarChart(aqi);
        })
        .catch(error => {
            console.error("Error fetching AQI data: ", error);
            document.getElementById("aqiStatus").innerText = "Failed to fetch AQI data.";
        });
}

// Function to categorize AQI status
function getAQIStatus(aqi) {
    if (aqi === 1) return 'Good';
    if (aqi === 2) return 'Fair';
    if (aqi === 3) return 'Moderate';
    if (aqi === 4) return 'Poor';
    return 'Very Poor';
}

// Function to update AQI Radar Chart
function updateAQIRadarChart(aqi) {
    const ctx = document.getElementById('radarChart').getContext('2d');
    const radarChartData = {
        labels: ['AQI'],
        datasets: [{
            label: 'Air Quality Index',
            data: [aqi],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    if (window.radarChart) {
        window.radarChart.destroy(); // Destroy previous chart if exists
    }

    window.radarChart = new Chart(ctx, {
        type: 'radar',
        data: radarChartData,
        options: {
            scale: {
                ticks: {
                    beginAtZero: true,
                    max: 5 // Max AQI level
                }
            }
        }
    });
}

// Function to fetch AQI data for top cities
function getAQIForTopCities() {
    const apiKey = '49bcd6ab5212e1c6b9f3d6064f58f996'; // Replace with your OpenWeatherMap API key
    const aqiDataPromises = topCities.map(city => {
        const { lat, lon } = cityCoordinates[city];
        const aqiUrl = `https://api.openweathermap.org/data/2.5/air_pollution?lat=${lat}&lon=${lon}&appid=${apiKey}`;
        
        return fetch(aqiUrl)
            .then(response => response.json())
            .then(data => ({
                city,
                aqi: data.list[0].main.aqi // Extract AQI value from the response
            }))
            .catch(error => {
                console.error(`Error fetching AQI data for ${city}: `, error);
                return { city, aqi: null };
            });
    });

    // After fetching AQI data for all cities, populate the chart
    Promise.all(aqiDataPromises).then(aqiData => {
        const cities = aqiData.map(item => item.city);
        const aqiValues = aqiData.map(item => item.aqi);

        // Update the AQI comparison chart
        updateAQIComparisonChart(cities, aqiValues);
    });
}

// Function to update the AQI comparison chart
function updateAQIComparisonChart(cities, aqiValues) {
    const ctx = document.getElementById('barChart').getContext('2d');

    if (window.barChart) {
        window.barChart.destroy(); // Destroy previous chart if exists
    }

    window.barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: cities, // City names on the x-axis
            datasets: [{
                label: 'AQI Levels',
                data: aqiValues, // AQI data for each city
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'AQI Value'
                    }
                }
            }
        });
}

// Call getAQIForTopCities to fetch data and update chart when page loads
window.onload = () => {
    getAQIForTopCities(); // Fetch AQI data for top cities on page load
};
