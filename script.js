function pullGacha() {
    // Send a request to the server to simulate a gacha pull
    fetch('gacha.php')
        .then(response => response.json())
        .then(data => {
            displayResult(data);
        })
        .catch(error => {
            console.error('Error pulling gacha:', error);
        });
}

function displayResult(result) {
    var resultElement = document.getElementById('result');
    resultElement.innerHTML = '';

    // Display the result message
    var message = document.createElement('p');
    message.textContent = result.message;
    resultElement.appendChild(message);

    // If an item is obtained, display its details
    if (result.item) {
        var itemDetails = document.createElement('p');
        itemDetails.textContent = 'You obtained: ' + result.item.name;
        resultElement.appendChild(itemDetails);
        const gachaResult = 'assets/img/' + result.item.name + '.jpg';
        openPopup(gachaResult);
    }

}

function openPopup(imageUrl) {
    const popup = document.getElementById('popup');
    const popupImage = document.getElementById('popup-image');

    popupImage.src = imageUrl;
    popup.style.display = 'flex';
}

function closePopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'none';
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}