<!DOCTYPE html>
<html>
<head>
  <?php include('head.html'); ?>
</head>
<header>
  <?php include('header.html'); ?>
</header>

<!-- body -->
<body>
  <div class="macrocontainer">
      <div class="left">
        <a href="#"> <!-- it goes to the link in Wikidata -->
              <?php echo "<img src=\"images/photo/" . $_GET["photo"] . ".jpg\" width=\"100%\">"; ?>
        </a>
      </div>
      <div class="right">
        <!-- related Books -->
        <?php include("books/books-matrix-.html"); ?> <!-- books-matrix-" . $_GET["photo"] . ".html"); ?> -->
        <!-- end related Books -->
      </div>
      <div class="middle">
        <!-- legend under the picture of the main object -->
        <?php
        $photo=$_GET["photo"];
        $file = fopen("../data-form/IHM-DB-dec-2019-pipe.tsv", "r") or die("Cannot open file!\n");
        while ($line = fgets($file, 1024)) {
            if (preg_match("/\b$photo\b/i", $line)) {
                $data = explode('|', $line);
            }
        }
        fclose($file);

        echo "<p style=\"padding: 0px 0px 0px 10%; color:white;\">";
        echo "<b>$data[3]</b>";
        echo"<br>$data[5]</br>";
        echo "<a href=\"https://creativecommons.org/licenses/by-sa/4.0\" title=\"Creative Commons Attribution-Share Alike 4.0\">CC BY-SA 4.0</a>";
        echo "</p>";
        ?>
        <!-- end legend under the picture -->
      </div>
      <div class="below">
        <!-- related photos -->
        <?php include("relates/related-books-.html"); ?> <!-- related-books-" . $_GET["photo"] . ".html"); ?> -->
        <!-- end related photos -->
      </div>
  </div>
</body>
<!-- end main body -->

<footer>
  <?php include('footer.html'); ?>
</footer>
</html>
