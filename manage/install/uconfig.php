<form method="post" action="?id=USERCONFIG">
        <table cellpadding="4" cellspacing="2" border="0">
        <tr>
            <td>First Name</td><td>*:<td><input type="text" name="fname" required size="40"></td><td>&nbsp;</td>
        </tr> 
        <tr>
            <td>Last Name</td><td>:<td><input type="text" name="lname" size="40"></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>E-Mail</td><td>*:</td><td><input type="email" name="email" required size="40"></td><td>(e.g. yourname@example.com)</td>
        </tr>
        <tr>
            <td>Password</td><td>*:</td><td><input type="password" name="password" required size="40"></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>Confirm Password</td><td>*:</td><td><input type="password" name="cpassword" required size="40"></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>Mobile</td><td>*:</td><td><input type="text" name="mobile" required size="40" maxlength="10"></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="nav_id" value="3<?php echo uniqid() ?>">
                <input type="hidden" name="userconfig" value="true">
                <input type="hidden" name="cms_installation" value="<?php echo uniqid() ?>">
                <input type="hidden" name="install_id" value="<?php echo uniqid() ?>">
            </td>
            <td>
            &nbsp;
            </td>
            <td>
                <input type="submit" value="Save User" class="button">
            </td>
        </table>
</form>
