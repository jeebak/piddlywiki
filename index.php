<?php
$tiddlywiki = 'wiki.html';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (!file_exists($tiddlywiki)) {
    file_put_contents($tiddlywiki, file_get_contents('http://tiddlywiki.com/empty.html'));
    die(file_get_contents('docs/setup.html'));
  }

  die(file_get_contents($tiddlywiki));
}

if (
  isset($_FILES['userfile']['tmp_name']) &&
  move_uploaded_file($_FILES['userfile']['tmp_name'], $tiddlywiki) &&
  file_exists('Git.php')
) {
  // https://github.com/kbjr/Git.php
  //   curl -o Git.php https://raw.githubusercontent.com/kbjr/Git.php/master/Git.php
  require_once('Git.php');
  $repo = Git::open('.');
  if ($repo->add($tiddlywiki)) {
    $repo->commit("Auto-updating: $tiddlywiki", FALSE);
  }
}
