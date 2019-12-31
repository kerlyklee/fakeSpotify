<?php
class Album {
    private $connection;
    private $id;
    private $title;
    private $artistID;
    private $genre;
    private $artworkPath;
    
    

    
    public function __construct($connection, $id) {
        $this->connection = $connection;
        $this->id = $id;
        $albumQuery = mysqli_query($connection, "SELECT * FROM albums WHERE id='$this->id'");
        $album = mysqli_fetch_array($albumQuery);
        $this->title = $album['title'];
        $this->artistId = $album['artist'];
        $this->genre = $album['genre'];
        $this->artworkPath = $album['artworkPath'];
    }
    public function getTitle() {

        return $this->title;
    }
    public function getArtworkPath() {
        return $this->artworkPath;
    }
    public function getArtist() {
        return new Artist($this->connection, $this->artistId);
    }
    public function getGenre() {
        return $this->genre;
    }
    public function getNumberOfSongs() {
        $numQuery = mysqli_query($this->connection, "SELECT id FROM songs WHERE album='$this->id'");
        return mysqli_num_rows($numQuery);
    }
    public function getSongIds() {

        $query = mysqli_query($this->connection, "SELECT id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");

        $array = array();

        while($row = mysqli_fetch_array($query)) {
            array_push($array, $row['id']);
        }

        return $array;

    } 


}
?>