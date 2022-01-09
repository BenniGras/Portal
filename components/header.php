<?php 

if(isset($_SESSION['login'])) {
    include "../components/header_logged_in.html";
} else {
    include "../components/header_logged_out.html";
}

?>