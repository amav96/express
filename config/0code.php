<?php
    header('Access-Control-Allow-Origin: *');
    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
        $location = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        
        if (isset($_REQUEST['editado'])) {
           header('Location: '.$location.'?editado=true');
        }else{ 
            header('Location: '.$location);
        }
    } 