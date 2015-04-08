<!DOCTYPE HTML>

<HTML>
    <HEAD>
        <TITLE>Dump install is OK</TITLE>
    </HEAD>
    <BODY>
        <form  method="post" accept-charset="utf-8" action="index.php">
            <DIV>
                <label><b>Dump install is OK</b></label>
                <br>
                <input type="hidden" value="{$database_name}" name="database_name">
                <input type="hidden" value="{$server_name}" name="server_name">
                <input type="hidden" value="{$user_name}" name="user_name">
                <input type="hidden" value="{$password}" name="password">
                <input type="submit" value="Go into site">
            </DIV>
        </form>
    </BODY>
</HTML>