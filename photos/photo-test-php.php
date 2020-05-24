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
        <p>
          <a href="https://commons.wikimedia.org/wiki/File:5_porte-empreinte_-_IHM-0641.jpg#/media/File:5_porte-empreinte_-_IHM-0641.jpg">
              <?php echo "<img src=\"images/photo/" . $_GET["photo"] . ".jpg\" width=\"100%\">"; ?>
          </a>
        </p>
      </div>
      <div class="right">
        <!-- books-releated script -->
        <?php include('right-books.html'); ?>
      </div>
      <div class="middle">
        <!-- main picture related legend script -->
        <?php include('middle-legend.html'); ?>
      </div>
      <div class="below">
        <!-- related photos script -->
        <?php include('below-photos.html'); ?>
      </div>
  </div>
</body>
<!-- end main body -->

<footer>
  <?php include('footer.html'); ?>
</footer>
</html>
