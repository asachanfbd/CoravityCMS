
        <form method="post" action="?id=DBCONFIG">
        <table cellpadding="4" cellspacing="2" border="0">
        <tr>
            <td>Hostname</td><td>*:<td><input type="text" name="hostname" value="localhost" required size="40"></td>
        </tr>
        <tr>
            <td>Database Name</td><td>*:</td><td><input type="text" name="dbname" required size="40"></td>
        </tr>
        <tr>
            <td>User Name</td><td>*:</td><td><input type="text" name="dbusername" required size="40"></td>
        </tr>
        <tr>
            <td>Password</td><td>&nbsp;&nbsp;:</td><td><input type="password" name="password" size="40"></td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="dbconfig" value="true">
                <input type="hidden" name="testconn" value="true">
                <input type="hidden" name="nav_id" value="2<?php echo uniqid() ?>">
                <input type="hidden" name="cms_installation" value="<?php echo uniqid() ?>">
                <input type="hidden" name="install_id" value="<?php echo uniqid() ?>">
            </td>
            <td>
            &nbsp;
            </td>
            <td>
                <input type="submit" value="Save  Database Connection Settings" class="button">
            </td>
        </table>
        </form>