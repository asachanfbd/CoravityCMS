<?php
    if(isset($_GET['pagename'])){
?>
            <form action="controller.php" method="post" class="ajaxsubmitform">
            <input type="hidden" value="pages" name="page" id="page">
            <input type="hidden" value="<?php echo $_GET['pagename']; ?>" name="type" id="type">
            <input type="hidden" value="" name="ajaxrequest" id="ajaxrequest">
                <table width="100%" class="listnerbox">
                    <tr>
                        <td colspan="3" class="smallfont">Edit the content here to appear in your home page.</td>
                    </tr>
                    <tr>
                        <td>Title</td><td>:</td><td><input type="text" value="<?php echo $contentpages->gettitle($_GET['pagename']); ?>" name="pagetitle" id="pagetitle" class="codelib_input_box"></td>
                    </tr>
                    <tr>
                         <td>Parent</td><td>:</td>
                         <td>
                         <select name="selectparent">
                            <option value="root">Root</option>
                         <?php $re=$db->querydb("select distinct(`title`), name from pages where parent = 'root'");
                         // $re=$db->querydb("select distinct(`title`), name from pages where type = 'mainnavigation'");
                            if($re->num_rows){
                                while($ro=$re->fetch_object()){
                                echo '<option value= "'.$ro->name.'" ';
                                if($contentpages->getparent($_GET['pagename']) == $ro->name){
                                    echo 'selected = "selected"';
                                }
                                echo '>'.$ro->title.'</option>';
                                }
                            } 
                            ?>
                             </select>
                             &nbsp;Priority: <input type="text" name="priority" id="priority" placeholder="Enter Page Priority" value="<?php echo $contentpages->getpriority($_GET['pagename']); ?>">
                             </td>
                    </tr>
                    
                    <tr>
                    
                        <td colspan="3">
                        Page Content
                        <textarea class="mceEditor" style="width: 90%; height: 400px;" name="pagecontent" id="pagecontent"><?php echo $contentpages->getcontent($_GET['pagename']); ?></textarea>
                        </td>
                    </tr>
                    <tr class="hide">
                        <td colspan="3">
                        S.E.O Tags
                        <textarea style="width: 90%; height: 100px;" name="pageseotags" id="pageseotags"><?php echo $contentpages->getseotags($_GET['pagename']); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="submit" value="Save" name="fullnamesubmitb" id="fullnamesubmitb">
                        <input type="button" value="Delete" name="deletebutton" id="deletebutton" onclick="deletepage(this, '<?php echo $_GET['pagename'] ?>')" >
                        <input onclick="cancelprofileedit(this)" type="button" value="Cancel" class="cancelsetting">
                    </tr>
                </table>
            </form>
<?php
    }
 ?>