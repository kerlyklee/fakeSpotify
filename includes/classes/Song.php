<?php
class Song {
    private $connection;
    private $id;
    private $mysqliData;
    private $title;
    private $artistId;
    private $albumId;
    private $genre;
    private $duration;
    private $path;


    
    

    
    public function __construct($connection, $id) {
        $this->connection = $connection;
        $this->id = $id;
        $songQuery = mysqli_query($connection, "SELECT * FROM songs WHERE id='$this->id'");
        $this->mysqliData = mysqli_fetch_array($songQuery);
        $this->title = $this->mysqliData['title'];
        $this->artistId = $this->mysqliData['artist'];
        $this->albumId = $this->mysqliData['album'];
        $this->genre = $this->mysqliData['genre'];
        $this->duration = $this->mysqliData['duration'];
        $this->path = $this->mysqliData['path'];
        
       
    }
    public function getTitle() {
        return $this->title;
    }
    public function getId() {
        return $this->id;
    }
    public function getArtist() {
        return new Artist($this->connection, $this->artistId);
    }
    public function getalbum() {
        return new Album($this->connection, $this->albumId);
    }
    public function getGenre() {
        return $this->genre;
    }
    public function getduration() {
        return $this->duration;
    }
    public function getPath() {
        return $this->path;
    }
    public function getMysqliData() {
        return $this->mysqliData;
    }

}
?>