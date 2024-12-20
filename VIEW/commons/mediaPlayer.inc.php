<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="VIEW/CSS/mediaPlayerStyle.css">
<div class="mediaPlayer mp-hide" id="mediaPlayer">
    <div class="imageContainer">
        <img id="mpSongImage" src="VIEW/IMAGES/song/defaultSong.png" alt="">
    </div>
    <div class="title">
        <p id="title">Song Title Here</p>
    </div>
    <div class="mediaControls">
        <button onclick="moveAround()" class="mediaButton" id="reverse">⏮</button>
        <button onclick="togglePlayPause()" class="mediaButton" id="play-pause">⏸</button>
        <button onclick="moveAround('forward')" class="mediaButton" id="forward">⏭</button>
    </div>
    <div class="closeMedia">
        <button onclick="closeMediaPlayer()" id="closeMedia">🗙</button>
    </div>
</div>

<!-- JS to make Media Player dynamic -->
<script>
    var elemMediaPlayer = document.getElementById("mediaPlayer");
    var elemMediaPlayerTitle = document.getElementById("title");
    var elemMediaPlayerImage = document.getElementById("mpSongImage");

    function closeMediaPlayer(){
        audio.pause();
        audio.currentTime = 0;
        elemMediaPlayer.classList.toggle("mp-transit");
        elemMediaPlayer.classList.toggle("mp-hide");
        setTimeout(function(){elemMediaPlayer.classList.toggle("mp-transit")},700);
    }

    function playMedia(i){
        songTitle = document.getElementById("songTitle" + i).innerHTML;
        songImage = document.getElementById("songImage" + i).src;
        audio = document.getElementById("audio" + i);
        elemMediaPlayerTitle.innerHTML = songTitle;
        elemMediaPlayerImage.src = songImage;
        document.getElementById("play-pause").innerHTML = "⏸";
        elemMediaPlayer.classList.toggle("mp-transit");
        elemMediaPlayer.classList.toggle("mp-hide");
        setTimeout(function(){elemMediaPlayer.classList.toggle("mp-transit")},700);
        audio.play();
        playtime(audio);
    }

    function playtime(audio){
        timerX = setInterval(timeLine, 50);
        audio.onended = function(){
            clearInterval(timerX);
            document.getElementById("mediaPlayer").style.backgroundSize = 0+"%";
            document.getElementById("play-pause").innerHTML = "⏵";
        };
    }

    function updateTimeLine(){
        clearInterval(timerX);
        timerX = setInterval(timeLine, 50);
    }

    function timeLine(){
            bgFill = audio.currentTime * 100 / audio.duration;
            document.getElementById("mediaPlayer").style.backgroundSize = bgFill + "%";
        }

    
        function togglePlayPause(){
        if(document.getElementById("play-pause").innerHTML === "⏸"){
            audio.pause();
            document.getElementById("play-pause").innerHTML = "⏵";
        } else {
            audio.play();
            updateTimeLine();
            document.getElementById("play-pause").innerHTML = "⏸";
        }
    }

    function moveAround(direction){
        if(direction === "forward"){
            audio.currentTime += 5;
        } else {
            audio.currentTime -= 5;
        }
    }
</script>