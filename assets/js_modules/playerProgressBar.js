const playerProgressBar = () => {
    // Wait for the audio player to load
    const audioPlayer = document.getElementById('audio-player');
    const progressBar = document.getElementById('progress');
    const currentTimeDisplay = document.getElementById('current-time'); // Current time display
    const durationDisplay = document.getElementById('duration'); // Duration display

    // Update the progress bar as the audio plays
    audioPlayer.addEventListener('timeupdate', function () {
        const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        progressBar.style.width = progress + '%';

        // Update the current time display
        const currentMinutes = Math.floor(audioPlayer.currentTime / 60);
        const currentSeconds = Math.floor(audioPlayer.currentTime % 60);
        currentTimeDisplay.textContent = `${currentMinutes}:${currentSeconds < 10 ? '0' + currentSeconds : currentSeconds}`;

        // Update the duration display
        const durationMinutes = Math.floor(audioPlayer.duration / 60);
        const durationSeconds = Math.floor(audioPlayer.duration % 60);
        durationDisplay.textContent = `${durationMinutes}:${durationSeconds < 10 ? '0' + durationSeconds : durationSeconds}`;
    });

    // Optional: you could add logic to format the time better (e.g., 0:00 vs 00:00) for better UX.
};

export { playerProgressBar };
