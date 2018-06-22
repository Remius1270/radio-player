$(document).ready(function(){

  //vars setup

  var main = $('#main')[0];

  var main_source = $('#main_audioSource');

  var structure = get_structure();

  var current_playlist = 0;

  var current_music = 0;

  var playlists_size = structure.length - 1;

  var frequency = 0;

  // Functions to call

  function set_source(player_source,player,music_path)
  {
    player_source.attr('src',music_path);
    player.load();
    player.play();
  }

  function get_structure()
  {
    return JSON.parse($("#structure").html());
  }

  function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
  }

  function checkend(player,player_source)
  {
    var length = player.duration;
    if(length == player.currentTime)
    {
      next_music = getRandomInt(structure[current_playlist][1].length);

      if(current_music == next_music)
      {
        next_music -=  1;
      }

      current_music = next_music;

      set_source(player_source,player,"music/"+first_playlist[0]+"/"+structure[current_playlist][1][next_music]);
    }
  }

  //event triggered functions

  $(document).bind('keydown',function(e){
     if(e.keyCode == 38) {
        current_playlist+=1;
     }
     else if(e.keyCode == 40) {
         current_playlist-=1;
    }
    if(current_playlist < 0 )
    {
      current_playlist= 0;
      set_source(main_source,main,"alert/too_low.wav");
    }
    else if(current_playlist > structure.length)
    {
      current_playlist = structure.length-1;
      set_source(main_source,main,"alert/too_high.wav");
    }
    else
    {
      next_music = getRandomInt(structure[current_playlist][1].length);

      set_source(main_source,main,"music/"+structure[current_playlist][0]+"/"+structure[current_playlist][1][next_music]);
    }

  });

  //initial script

  var first_playlist = structure[0];
  var random_music = getRandomInt(first_playlist[1].length);

  current_music = random_music;

  set_source(main_source,main,"music/"+first_playlist[0]+"/"+first_playlist[1][random_music]);

  setInterval(function(){
    checkend(main,main_source);
  },5000);

});
