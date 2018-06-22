<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Radio</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">

  <link rel="stylesheet" href="css/style.css">
  <script src="js/ewoksoundsystem.js"></script>
</head>

<body>

  <audio controls  id="main">
    <source src="" type="audio/mpeg" id="main_audioSource" >
    Your browser does not support the audio tag.
  </audio>

  <div id="current" >Playlist : 0</div>

<?php
    $musicPath = "./music/"; //toutes les plylist sont contenues dans le dossier musique
    $playlists = scandir($musicPath); //récupération de tous les dossiers de playlist

    $music_structure = array();// ici que sera stocké sous forme de -> titre  et -> (array)musiques pour avoir l'archi des plylists

    foreach ($playlists as $key => $playlist)
    {
      $playlist_container = array();
      if(is_dir($musicPath.$playlist) && $playlist != '.' && $playlist != '..') // on affiche toutes les playlists sauf "." et ".." qui sont des indexes
      {

        $playlist_title = $playlist;
        $playlist_musics = array();

        $musics = scandir($musicPath.$playlist."/");

        foreach($musics as $key => $music)
        {
            if($music != "." && $music != "..")
            {
              $music_name = $music;
              array_push($playlist_musics,$music_name);
            }
        }
        array_push($playlist_container,$playlist_title,$playlist_musics);
        array_push($music_structure,$playlist_container);
      }

    }
    echo "<div id='structure' >".json_encode($music_structure)."</div>";
    ?>


</body>

</html>
