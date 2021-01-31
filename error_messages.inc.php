<?php

/*creates a session for errors to report
*name = name of the session
*errors = array of errors
*/
function setError($name, $errors)
{
    session_start();
    if(isset($errors))
    {
        $_SESSION["$name"] = $errors;
    }
}

function getErrors($name)
{
    session_start();
    if(isset($_SESSION["$name"]))
    {
        $e = $_SESSION["$name"];
        unset($_SESSION["$name"]);
        return $e;
    }
}
?>