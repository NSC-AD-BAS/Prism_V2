<?php
    require "query_db.php";
    require "../companies/page_builder.php";
    
    $userId = $_GET['UserId'];

    render_header("Edit Note", false);
    render_nav("Edit Note");

?>
<div class="wrapper">
    <div class="detail_table">
        <form action="create_note_post.php" method="post">
            <table>
                <tr>
                    <td>Note Type</td>
                    <td><input class="textbox" name="note[type]" type="text"></td>
                </tr>
                <tr>
                    <td>Text</td>
                    <td><input class="textbox" name="note[text]" type="text"></td>
                </tr>
                <input type="hidden" name="note[UserId]" value="<?=$userId?>">
            </table>
            <hr>
            <div>
                <input class="form_button "type="submit" value="Save">
                <a class="button" href="detail.php?id=<?=$userId?>"><div>Cancel</div></a>
            </div>
        </form>
        
    </div>
</div>

<?php render_footer(); ?>
