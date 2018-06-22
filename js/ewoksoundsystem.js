$(document).ready(function(){

  //vars setup

  var main = $('#main')[0];

  var main_source = $('#main_audioSource');

  var structure = get_structure();

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

  //initial script

  var first_playlist = structure[0];
  var random_music = getRandomInt(first_playlist[1].length);

  set_source(main_source,main,"music/"+first_playlist[0]+"/"+first_playlist[1][random_music]);

});
