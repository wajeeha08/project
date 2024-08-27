function displayAudioName(input) {
    const audioPlayer = document.getElementById('audioPlayer');
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileURL = URL.createObjectURL(file);
        audioPlayer.src = fileURL;
        audioPlayer.load();  // Load the new audio source
        audioPlayer.play();  // Optionally play the audio automatically
    }
}


function displayBanner(input) {
    const bannerViewer = document.getElementById('BannerViewer');
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileURL = URL.createObjectURL(file);
        bannerViewer.src = fileURL;
        bannerViewer.style.display = 'block'; // Ensure the image is displayed
    }
}
function displayVideo(input) {
    const videoPlayer = document.getElementById('videoPlayer');
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileURL = URL.createObjectURL(file);
        videoPlayer.src = fileURL;
        videoPlayer.load();  // Load the new video source
        videoPlayer.play();  // Optionally play the video automatically
    }
}