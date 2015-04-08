<?php /* Smarty version 2.6.28, created on 2015-04-06 18:00:15
         compiled from install.tpl */ ?>
<!DOCTYPE HTML>

<HTML>
    <HEAD>
        <TITLE>Install dump BD</TITLE>
    </HEAD>
    <BODY>
        <form  method="post" accept-charset="utf-8" action="install.php">
            <DIV>
                <label><b>Server name:</b></label>
                <BR>
                <input type="text" maxlength="40" value="localhost" name="server_name">
            </DIV>
            <DIV>
                <label><b>User name:</b></label>
                <BR>
                <input type="text" maxlength="40" value="test" name="user_name">
            </DIV>
            <DIV>
                <label><b>Password:</b></label>
                <BR>
                <input type="text" maxlength="40" value="123" name="password">
            </DIV>
            <DIV>
                <label><b>Database:</b></label>
                <BR>
                <input type="text" maxlength="40" value="test" name="database_name">
            </DIV>
            <DIV>
                <input type="submit" name="button_install" value="Install">
            </DIV>
        </form>
    </BODY>
</HTML>