<?php
  echo '<p class=green>Congrats! Coravity CMS has been successfully installed.</p>';
  echo '<form action="index.php">
        <input type="submit" value="Login" class="button">
        </form>
  ';
  createfile('log.txt', 'Installation Finish');
?>
