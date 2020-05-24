<?php
/*
 * ================
 * Error reporting.
 * ================
 */
error_reporting(E_ALL);
ini_set('display_errors', 0); // SET IT TO 0 ON A LIVE SERVER !!!

/*
 * ==================================================================
 * Execute operations upon form submit (store form data in date.csv).
 * ==================================================================
 */
include 'php/create-csv.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
        <meta charset="UTF-8" />
        <!-- The above 3 meta tags must come first in the head -->

        <title>demo-1</title>
    </head>
    <body>
        <div class="formme">
            <form action="" method="post">
                <?php
                /*
                 * Display all errors if any.
                 */
                if (isset($errors)) {
                    ?>
                    <div class="errors">
                        <?php
                        foreach ($errors as $error) {
                            ?>
                            <p style="color:#ff0000">
                                <?php echo $error; ?>
                            </p>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>

                <div class="form-1">
                    <div class="col-1">
                        <label for="fname" class="fname">First name</label>
                    </div>
                    <div class="ph-1">
                        <input type="text" id="fname" name="fname" placeholder="Your name...">
                    </div>
                </div>

                <div class="form-2">
                    <div class="col-2">
                        <label for="lname" class="lname">Last name</label>
                    </div>
                    <div class="ph-2">
                        <input type="text" id="lname" name="lname" placeholder="Your last name...">
                    </div>
                </div>

                <div class="form-3">
                    <div class="col-3">
                        <label for="telNo" class="tel">Phone number</label>
                    </div>
                    <div class="ph-3">
                        <input type="tel" id="telNo" name="telNo" placeholder="Your phone number...">
                    </div>
                </div>

                <div class="form-4">
                    <div class="col-4">
                        <label for="description" class="tel">Description</label>
                    </div>
                    <div class="ph-4">
                        <input type="text" id="description" name="description" placeholder="enter the text...">
                    </div>
                </div>

                <div class="btn">
                    <input type="submit" name="submit" id="submit" value="Submit">
                </div>
            </form>
        </div>
    </body>
</html>
