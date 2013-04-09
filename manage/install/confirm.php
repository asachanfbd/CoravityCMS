<form action="?id=CONFIRM">
<textarea name="message" cols="80" rows="18" disabled="true" id="textar">
What is a CMS (Content Management System)?  
A Content Management System is a series of programming pages connected to a database that allows one to retrieve information from that database in the form of content. Sounds complicated? You’ve used one more often that you think.   
Have you ever updated your Facebook page or created a blog? Have you ever bought a book from Amazon.com or bid on something on eBay? Have you ever read The New York Times Online or checked something out on Wikipedia? All of these sites work with a type of Content Management System.   
The ones we will be focusing on are ones that allow you to manage your own website from a simple interface, to creating your own pages and menus without the need for knowing how to program yourself. 
</textarea><br>
<input type="checkbox" name="check" required> I agree to all terms and conditions of using this application.<br>
<input type="hidden" name="nav_id" value="1<?php echo uniqid(); ?>">
<input type="hidden" name="cms_installation" value="<?php echo uniqid(); ?>">
<input type="hidden" name="install_id" value="<?php echo uniqid(); ?>">
<input type="submit" value="Continue" class="button"/>
</form>
