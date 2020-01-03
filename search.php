<?php
include("includes/includedFiles.php");
if(isset($_GET['term'])){
    $term = urldecode($_GET['term']);
    
}
else {
    $term = "";
}

?>

<div class="searchContainer">
    <h4>Search for song, artist or album</h4>
    <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="this.value = this.value">

</div>
<script>
$(".searchInput").focus();
$(function() {
    var timer;
    $(".searchInput").keyup(function(){
        clearTimeout(timer);

        timer = setTimeout(function() {
            var val = $(".searchInput").val();
            openPage("search.php?term=" +val);
        }, 2000);
    })
})
</script>



<div class="tracklistContainer borderBottom">
	<h2>Songs</h2>
    <ul class="trackList">
        <?php
        $songsQuery = mysqli_query($connection, "SELECT id FROM songs WHERE title LIKE '$term%'");

        if(mysqli_num_rows($songsQuery) == 0) {
            echo "<span class='noResults' >No songs found matching" . $term . "</span>";
        }
        $i = 1;
        $songIdArray = array();
        while($row = mysqli_fetch_array($songsQuery)) {
			if($i > 15) {
				break;
            }
            array_push($songIdArray, $row['id']);
           $albumSong = new Song($connection,  $row['id']);
           $albumArtist = $albumSong->getArtist();
           echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                    <img class='play' src='assets/images/icons/play-white.png' <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'> 
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'> " . $albumSong->getTitle() . "</span>
                        <span class='artistName'> " . $albumArtist->getName() . "</span>
                    </div>
                    <div class='trackOptions'>
                        <img class='optionsButton' src='assets/images/icons/more.png'>
                    </div>
                    <div class='trackDuration'>
                        <span class='duration'>" . $albumSong->getDuration() . "</span>
                    </div>
                </li>";
                $i++;
          

        } 
        ?>
        <script>
           var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>

<div class="artistContainer borderBottom">
    <h2>Artitsts</h2>
    <?php
    $artistsQuery = mysqli_query($connection, "SELECT id FROM artists WHERE name LIKE '$term%'");
    if(mysqli_num_rows($artistsQuery) == 0) {
        echo "<span class='noResults' >No artists found matching" . $term . "</span>";
    }
    while($row = mysqli_fetch_array($artistsQuery)) {
        $artistFound = new Artist($connection, $row['id']);

        echo "<div class='searchResultRow>
                <div class='artistName'>
                    <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() ."\"'>
                     "
                     . $artistFound->getName() .
                     "   
                    </span>
                
                </div>
        
            </div>";
    }
    ?>

</div>