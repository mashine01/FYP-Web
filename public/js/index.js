function showOption() {
  var selectedOption = document.getElementById("optionSelect").value;
  if (selectedOption === "weather") {
    document.getElementById("weatherInput").style.display = "block";
    document.getElementById("sportsContent").style.display = "none";
  } else if (selectedOption === "sports") {
    document.getElementById("weatherInput").style.display = "none";
    document.getElementById("sportsContent").style.display = "block";
    // Run sports code here
    console.log("Sports code running...");
  } else {
    document.getElementById("weatherInput").style.display = "none";
    document.getElementById("sportsContent").style.display = "none";
  }
}

function addCity() {
  var cityInput = document.getElementById("cityInput").value;
  var cityList = document.getElementById("cityList");
  var listItem = document.createElement("li");
  listItem.textContent = cityInput;
  cityList.appendChild(listItem);
}

function getWeather() {
  var cities = [];
  var lis = document.getElementById("btn");
  for (var i = 0; i < lis.length; i++) {
    cities.push(lis[i].textContent);
  }
  console.log("Getting weather for cities:", cities);
  // You can make API calls here to get weather information for the cities
}
