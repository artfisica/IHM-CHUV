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
        <?php include('books-matrix.html'); ?>
        <!-- end related Books -->
      </div>
      <div class="middle">
        <?php include('book-legend.html'); ?>
      </div>
      <div class="below">
        <!-- related photos -->
        <?php include('related-books.html'); ?>
      </div>
  </div>
</body>
<!-- end main body -->

<footer>
  <?php include('footer.html'); ?>
</footer>
</html>
