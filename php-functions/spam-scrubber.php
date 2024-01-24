<?php
function spam_scrubber($value) {

    // List of very bad values:
    $very_bad = ['to:', 'cc:', 'bcc:', 'content-type:', 'mime-version:', 'multipart-mixed:', 'content-transfer-encoding:', 
    'giveaway', 'winner', 'call now', 'free trial', 'click here', 'not spam', 'not junk'];

    // If any of the very bad strings are in the submitted value, return an empty string:
    foreach ($very_bad as $v) {
        if (stripos($value, $v) !== false) return '';
    }

    // Replace any newline characters with spaces:
    $value = str_replace(["\r", "\n", "%0a", "%0d"], ' ', $value);

    // Return the value:
    return trim($value);

} // End of spam_scrubber() function

?>