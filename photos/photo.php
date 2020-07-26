<!DOCTYPE html>
<html>
<head>
  <?php include('head.html'); ?>
</head>
<header>
  <?php include('header.html'); ?>
</header>

<?php
    $photos = array("1.1", "1.2", "1.3", "1.4", "1.5", "1.6", "1.7", "1.8", "1.9", "1.10", "2.1", "2.2", "2.3", "2.4", "2.5", "2.6", "2.7", "2.8", "2.9", "2.10", "3.1", "3.2", "3.3", "3.4", "3.5", "3.6", "3.7", "3.8", "3.9", "3.10", "4.1", "4.2", "4.3", "4.4", "4.5", "4.6", "4.7", "4.8", "4.9", "4.10", "5.1", "5.2", "5.3", "5.4", "5.5", "5.6", "5.7", "5.8", "5.9", "5.10", "6.1", "6.2", "6.3", "6.4", "6.5", "6.6", "6.7", "6.8", "6.9", "6.10", "7.1", "7.2", "7.3", "7.4", "7.5", "7.6", "7.7", "7.8", "7.9", "7.10");

    if (in_array($_GET["photo"],$photos,TRUE))
    {
        /* good - continue */
    }
    else
    {
        header("Location: ../index.php"); /* Redirect browser to HOME */
        exit();
    }
?>

<!-- body -->
<body>
    <div class="macrocontainer">
      <div class="left">
        <a href="#"> <!-- it goes to the link in Wikidata -->
              <?php echo "<img src=\"images/photo/" . $_GET["photo"] . ".jpg\" width=\"100%\">"; ?>
              <?php
                  $cires = array("1.1", "1.2", "1.3", "1.4", "1.5", "1.6", "1.7", "1.8");

                  if (in_array($_GET["photo"],$cires,TRUE))
                  {
                     echo "<a style=\"color:white;font-size:150%;padding: 0px 0px 0px 7px;\" class=\"fa\" href=\"../glossaire.php\">&#xf05a;</a>";
                  }
             ?>
        </a>
      </div>
      <div class="right">
        <!-- related Books -->
        <?php include("books/books-matrix-" . $_GET["photo"] . ".html"); ?>
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
        echo "<a href=\"https://creativecommons.org/licenses/by-sa/4.0\" target=\"_blank\" title=\"Creative Commons Attribution-Share Alike 4.0\" >CC BY-SA 4.0</a>";
        echo "</p>";
        ?>
        <!-- end legend under the picture -->
      </div>
      <div class="below">
        <!-- related photos -->
        <?php include("relates/related-books-" . $_GET["photo"] . ".html"); ?>
        <!-- end related photos -->
      </div>
  </div>
</body>
<!-- end main body -->

<footer>
  <!-- foot from chuv -->
  <?php include('footer.html'); ?>
</footer>
</html>
