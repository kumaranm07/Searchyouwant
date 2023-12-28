<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@800&family=Merienda:wght@900&display=swap" 
    rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="topdiv">
        <div class="topic">
            <h1>MY BROWSER</h1>
        </div>
        <div class="innerdiv">
            <div class="container" id="child">
                <h3 class="title">Currency Converter</h3>
                <input type="text" name="amount" placeholder="Amount" id="amount"><br>
                <label for="fromCurrency">From Currency:</label>
                <select id="fromCurrency" class="currency" name="fromCurrency"></select>
                <br>
                <label for="toCurrency">To Currency:</label>
                <select id="toCurrency" class="currency" name="toCurrency"></select>
                <br>
                <button id="btn">Convert</button>
                <p id="result1"></p>
            </div>
            <form method="post" class="container1" id="child2">
                <div>
                    <p class="title">WEATHER</p>
                    <input type="text" placeholder="Location" name="city" class="input">
                    <input type="submit" name="submit" value="checkwhether" class="input2">
                </div>
                <div class="weather-container">
                    <div id="weather-info"></div>
                </div>
            </form>
            <div class="mapdiv" id="child3">
                <a href="map.php">click to go map page</a>
            </div>
        </div>
    </div>
    <div class="outerdiv">
        <script async src="https://cse.google.com/cse.js?cx=f17847b17988f4163">
        </script>
        <div class="gcse-searchbox"></div>
    </div>
    <div class="result">
    <div class="gcse-searchresults"></div>
    </div>
</body>
</html> 

<script>
fetch('https://api.exchangerate-api.com/v4/latest/USD')
    .then(response => response.json())
    .then(data => {
        const currencies = Object.keys(data.rates);

        const fromCurrencySelect = document.getElementById("fromCurrency");
        const toCurrencySelect = document.getElementById("toCurrency");

        currencies.forEach(currency => {
            const option1 = document.createElement("option");
            option1.value = currency;
            option1.text = currency;
            fromCurrencySelect.appendChild(option1);

            const option2 = document.createElement("option");
            option2.value = currency;
            option2.text = currency;
            toCurrencySelect.appendChild(option2);
        });
    })
    .catch(error => {
        console.error("Error fetching currencies: " + error);
    });

const select1 = document.getElementById("fromCurrency");
const select2 = document.getElementById("toCurrency");
const btn = document.getElementById("btn");

const num = document.getElementById("amount");
const ans = document.getElementById("result1");

btn.addEventListener("click", () => {
    event.preventDefault();
    let currency1 = select1.value;
    let currency2 = select2.value;
    let value = num.value;
    
    if (currency1 !== currency2) {
        convert(currency1, currency2, value);
    } else {
        alert("Choose Different Currencies !!!");
    }
});

function convert(currency1, currency2, value) {
    const host = "api.exchangerate-api.com";
    fetch(`https://${host}/v4/latest/${currency1}`)
        .then(response => response.json())
        .then(data => {
            const exchangeRate = data.rates[currency2];
            const result = value * exchangeRate;
            const resultParagraph = document.createElement("p");
            resultParagraph.textContent = `Result: ${result.toFixed(2)}`;
            ans.appendChild(resultParagraph);
        })
        .catch(error => {
            console.error("Error fetching exchange rate: " + error);
        });
}
</script>
<script src="weather.js"></script>