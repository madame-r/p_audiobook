const initAudiobookCover = () => {
    // Get the audiobook details div
    const audiobookDetails = document.querySelector('.audiobook-details');
    
    // Check if the div exists and if it has a data-cover attribute
    if (audiobookDetails && audiobookDetails.dataset.cover) {
        // Set the background-image to the value of the data-cover attribute
        audiobookDetails.style.backgroundImage = "url('" + audiobookDetails.dataset.cover + "')";
    }
};

export {initAudiobookCover}