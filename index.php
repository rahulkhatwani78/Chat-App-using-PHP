<?php
    session_start();

    if(isset($_POST['reset']))
    {
        $_SESSION['chats'] = array();
        header('Location: index.php');
        return;
    }

    if(isset($_POST['message']))
    {
        if(!isset($_SESSION['chats']))
            $_SESSION['chats'] = array();
        $_SESSION['chats'] [] = array($_POST['message'], date(DATE_RFC2822));
        header('Location: index.php');
        return;
    }
?>

<html>
    <head>
        <title>Rahul's Chat Application</title>
        <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
    </head>
    <body>
        <h1>Chat</h1>
        <form method="post">
            <p>
                <input type="text" name="message" size="60">
                <input type="submit" value="Chat">
                <input type="submit" value="Reset" name="reset">
            </p>
        </form>
        <div id="chatcontent">
            <img src="spinner.gif" alt="Loading...">
        </div>
        <script type="text/javascript">
            function updateMsg()
            {
                window.console && console.log("Requesting JSON");
                $.getJSON("chatlist.php", function(data) {
                    window.console && console.log("JSON Received");
                    window.console && console.log(data);
                    $('#chatcontent').empty();
                    for(var i=0; i<data.length; i++)
                    {
                        entry = data[i];
                        $('#chatcontent').append("<p>"+entry[0]+
                        "<br/>&nbsp;&nbsp;"+entry[1]+"</p>\n");
                    }
                    setTimeout('updateMsg()', 4000);
                });
            }
            window.console && console.log("Startup complete");
            updateMsg();
        </script>
    </body>
</html>