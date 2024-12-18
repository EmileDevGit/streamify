<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="VIEW/CSS/mediaPlayerStyle.css">
<audio src="<?php echo $_SESSION["audio"] ?>"></audio>
<div class="mediaPlayer mp-hide" id="mediaPlayer">
    <div class="imageContainer">
        <img id="mpSongImage" src="VIEW/IMAGES/song/defaultSong.png" alt="">
    </div>
    <div class="title">
        <p id="title">Song Title Here</p>
    </div>
    <div class="mediaControls">
        <button class="mediaButton" id="previousSong">⏮</button>
        <button onclick="togglePlayPause()" class="mediaButton" id="play-pause">⏸</button>
        <button class="mediaButton" id="nextSong">⏭</button>
    </div>
    <div class="closeMedia">
        <button onclick="toggleMediaPlayer()" id="closeMedia">🗙</button>
    </div>
</div>

<!-- JS to make Media Player dynamic -->
<script>
    var elemMediaPlayer = document.getElementById("mediaPlayer");
    var elemMediaPlayerTitle = document.getElementById("title");
    var elemMediaPlayerImage = document.getElementById("mpSongImage");

    function toggleMediaPlayer(){
        elemMediaPlayer.classList.toggle("mp-transit");
        elemMediaPlayer.classList.toggle("mp-hide");
        setTimeout(function(){elemMediaPlayer.classList.toggle("mp-transit")},700);
    }

    function playMedia(i){
        songTitle = document.getElementById("songTitle" + i).innerHTML;
        songImage = document.getElementById("songImage" + i).src;
        elemMediaPlayerTitle.innerHTML = songTitle;
        elemMediaPlayerImage.src = songImage;
        toggleMediaPlayer();
        //x.play();
    }

    function togglePlayPause(){
        if(document.getElementById("play-pause").innerHTML === "⏸"){
            //x.pause();
            document.getElementById("play-pause").innerHTML = "⏵";
        } else {
            //x.play();
            document.getElementById("play-pause").innerHTML = "⏸";
        }
    }
</script>