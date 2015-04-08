<?php /* Smarty version 2.6.28, created on 2015-04-06 18:23:53
         compiled from install_ok.tpl */ ?>
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
                <input type="hidden" value="<?php echo $this->_tpl_vars['database_name']; ?>
" name="database_name">
                <input type="hidden" value="<?php echo $this->_tpl_vars['server_name']; ?>
" name="server_name">
                <input type="hidden" value="<?php echo $this->_tpl_vars['user_name']; ?>
" name="user_name">
                <input type="hidden" value="<?php echo $this->_tpl_vars['password']; ?>
" name="password">
                <input type="submit" value="Go into site">
            </DIV>
        </form>
    </BODY>
</HTML>