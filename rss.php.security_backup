<?php

include('global.php');

header("Content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<rss xmlns:taxo=\"http://purl.org/rss/1.0/modules/taxonomy/\" xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" version=\"2.0\">";
echo "
  <channel>
    <title>Habbo Noticias</title>
    <link>" . WWW . "</link>
    <description>As Ultimas Noticias do Habbo Diretamente para Ca!</description>";

$data = db::query("SELECT * FROM site_news ORDER BY id DESC");
while ($row = mysql_fetch_array($data)) {

    echo "
    <item>
      <title>" . $row['title'] . "</title>
      <link>" . WWW . "/news.php?id=" . $row['id'] . "</link>
      <description>" . $row['short_story'] . "</description>
      <pubDate>" . $row['timestamp'] . "</pubDate>
      <guid isPermaLink=\"true\">" . WWW . "/news.php?id=" . $row['id'] . "</guid>
      <dc:date>" . $row['timestamp'] . "</dc:date>
    </item>";
}

echo "
</channel>
</rss>";
?>