const playerNavigation = () => {
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const playPauseButton = document.getElementById('play-pause-button');
    const nowPlayingElement = document.getElementById('now-playing');
    const audioPlayer = document.getElementById('audio-player');

    // Get the chapters data from Twig
    const chapters = JSON.parse(document.getElementById('chapters-data').textContent);

    let currentChapterIndex = 0;

    const loadChapter = (index) => {
        currentChapterIndex = index;
        audioPlayer.src = chapters[currentChapterIndex].audioUrl;
        nowPlayingElement.textContent = `${chapters[currentChapterIndex].title}`;

        // Wait for the metadata to load before playing
        audioPlayer.addEventListener(
            'loadedmetadata',
            () => {
                audioPlayer.play();
                playPauseButton.innerHTML = '<i class="bi bi-pause-circle"></i>'; // Update icon to "Pause"
            },
            { once: true }
        );
    };

    // Load the initial chapter
    loadChapter(currentChapterIndex);

    // Handle "Next" button
    nextButton.addEventListener('click', () => {
        if (currentChapterIndex < chapters.length - 1) {
            loadChapter(currentChapterIndex + 1);
        }
    });

    // Handle "Previous" button
    prevButton.addEventListener('click', () => {
        if (currentChapterIndex > 0) {
            loadChapter(currentChapterIndex - 1);
        }
    });

    // Handle chapter click
    const chapterLinks = document.querySelectorAll('.chapters-list a');
    chapterLinks.forEach((link, index) => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            loadChapter(index);
        });
    });

    // Handle Play/Pause button
    playPauseButton.addEventListener('click', () => {
        if (audioPlayer.paused) {
            audioPlayer.play();
            playPauseButton.innerHTML = '<i class="bi bi-pause-circle"></i>'; // Update icon to "Pause"
        } else {
            audioPlayer.pause();
            playPauseButton.innerHTML = '<i class="bi bi-play-circle"></i>'; // Update icon to "Play"
        }
    });
};

export { playerNavigation };
