<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="Sales force connection app">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <h2> Sales Force API Connection App</h2>
        <input type="button" value="integrate" id="integrate-button"/> <span>show title here if they are integrated!</span>
        <table>
            <thead>

            </thead>
            <tbody>

            </tbody>
        </table>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $('document').ready(function(){
               $('#integrate-button').click(function(){
                    window.href = "https://login.salesforce.com/services/oauth2/token";
               });
            });
        </script>
    </body>
</html>
