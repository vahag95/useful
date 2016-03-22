<?php
//package willvincent/feeds

$feed = \Feeds::make(
        'http://www.armsport.am/hy/news/rss');
    $data = array(
      'title'     => $feed->get_title(),
      'permalink' => $feed->get_permalink(),
      'items'     => $feed->get_items(0,2),
    );

    foreach ($data['items'] as $key) {
        var_dump($key->get_permalink());
        echo "<br>";
        var_dump($key->get_title());
        echo "<br>";
        var_dump($key->get_description());
    }
$feed = \Feeds::make('http://www.armsport.am/hy/news/rss');

?>