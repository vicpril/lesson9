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
                <input type="text" maxlength="40" value="vicpril" name="user_name">
            </DIV>
            <DIV>
                <label><b>Password:</b></label>
                <BR>
                <input type="text" maxlength="40" value="123" name="password">
            </DIV>
            <DIV>
                <label><b>Database:</b></label>
                <BR>
                <input type="text" maxlength="40" value="lesson_9" name="database_name">
            </DIV>
            <DIV>
                <input type="submit" name="button_install" value="Install">
            </DIV>
        </form>
    </BODY>
</HTML>