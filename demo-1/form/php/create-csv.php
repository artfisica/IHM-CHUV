<?php

/*
 * ==================================================================
 * Execute operations upon form submit (store form data in date.csv).
 * ==================================================================
 */
if (isset($_POST['submit'])) {
    // Collect the form data.
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $phone = isset($_POST['telNo']) ? $_POST['telNo'] : '';
    $descr = isset($_POST['description']) ? $_POST['description'] : '';

    // Check if first name is set.
    if ($fname == '') {
        $errors[] = 'First name is required';
    }

    // Check if last name is set.
    if ($lname == '') {
        $errors[] = 'Last name is required';
    }

    // Validate the phone number.
    $pattern = '/^(?:\(\+?44\)\s?|\+?44 ?)?(?:0|\(0\))?\s?(?:(?:1\d{3}|7[1-9]\d{2}|20\s?[78])\s?\d\s?\d{2}[ -]?\d{3}|2\d{2}\s?\d{3}[ -]?\d{4})$/';
    if (!preg_match($pattern, $phone)) {
        $errors[] = 'Please enter a valid phone number';
    }

    // If no errors carry on.
    if (!isset($errors)) {
        // The header row of the CSV.
        $header = "FName,LName,Phone,Description\n";
        // The data of the CSV.
        $data = "$fname,$lname,$phone,$descr\n";

        /*
         * The file name of the CSV.
         *
         * NB: __DIR__ describes the location in which this file resides.
         * To go up one level use "dirname(__DIR__)".
         *
         * NB: You will not be able to append data to an existing file if you use time components
         * (hour, minutes, seconds) inside the file name. Imagine that you are creating a file
         * right now, at 12:18:43 o'clock. Then the file will be named "formdata-09-01-18-12-38-43.csv".
         * One second later you will not be able to append data to it because the time will be "12:38:44".
         * Then a new file "formdata-09-01-18-12-38-44.csv" will be created.
         *
         * I suggest using only the date whithout the time in the file name.
         *
         * @todo Read the comment above!
         */
        $fileName = dirname(__DIR__) . "/formdata-" . date("d-m-y-h-i-s") . ".csv";

        /*
         * Create the CSV file.
         * If file exists, append the data to it. Otherwise create the file.
         */
        if (file_exists($fileName)) {
            // Add only data. The header is already added in the existing file.
            file_put_contents($fileName, $data, FILE_APPEND);
        } else {
            // Add CSV header and data.
            file_put_contents($fileName, $header . $data);
        }
    }
}
