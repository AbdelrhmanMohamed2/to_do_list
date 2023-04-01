<?php
// ############ sanitize ######################
function sanitize($input)
{
    return trim(htmlentities(htmlspecialchars($input)));
}
// ############################################


// ############ max input #####################
function maxInputSize($input, $size)
{
    return strlen($input) > $size;
}
// ############################################


// ############ min input #####################
function minInputSize($input, $size)
{
    return strlen($input) < $size;
}
// ############################################