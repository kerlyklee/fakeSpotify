<?php
$songQuery = mysqli_query($connection, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
$resultArray = array();

while($row = mysqli_fetch_array($songQuery)) {
    array_push($resultArray, $row['id']);
}
$jsonArray = json_encode($resultArray);

?>
<script>
$(document).ready(function() {
    currentPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(currentPlaylist[0], currentPlaylist, false);
});
function setTrack(trackId, newPlaylist, play) {
    $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {
        var track = JSON.parse(data);


        $(".trackName span").text(track.title);
        $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist}, function(data) {
            var artist = JSON.parse(data);
            console.log(artist.name);
            $(".trackArtist span").text(artist.name);
            
        });
        audioElement.setTrack(track.path);
        audioElement.play();
    });
   if(play) {
        audioElement.play();
    }
    
}
function playSong() {
    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.play();
}
function pauseSong() {
    $(".controlButton.play").show();
    $(".controlButton.pause").hide();
    audioElement.pause();
}
    
</script>
<div id="nowPlayingContainer">

    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                <img src="https://i.ytimg.com/vi/rb8Y38eilRM/maxresdefault.jpg" class="albumCover" alt="Album Cover"> 
                </span>
                <div class="trackInfo">
                    <span class="trackName"> 
                        <span></span>
                    </span>
                    <span class="trackArtist"> 
                        <span></span>
                    </span>

                </div>
            </div>
        </div>
        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle button">
                        <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                    </button>

                    <button class="controlButton previous" title="Previous button">
                        <img src="assets/images/icons/previous.png" alt="Previous">
                    </button>

                    <button class="controlButton play" title="Play button" onclick="playSong()">
                        <img src="assets/images/icons/play.png" alt="Play">
                    </button>

                    <button class="controlButton pause" title="Pause button" onclick="pauseSong()" style="display: none;">
                        <img src="assets/images/icons/pause.png" alt="Pause">
                    </button>

                    <button class="controlButton next" title="Next button">
                        <img src="assets/images/icons/next.png" alt="Next">
                    </button>

                    <button class="controlButton repeat" title="Repeat button">
                        <img src="assets/images/icons/repeat.png" alt="Repeat">
                    </button>
                        
                </div> 
                <div class="playBar">
                    <span class="progressTime curent">0.00</span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress">

                            </div>
                        </div>
                    </div>
                    <span class="progressTime remaining">0.00</span>
                    
                </div>
            </div>
        </div>
        <div id="nowPlayingRight">
            <div class="volumeBar">
                <button class="controlButton volume" title="Volume button">
                    <img src="assets/images/icons/volume.png" alt="Volume">
                </button>
                <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress">

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>      
</div>