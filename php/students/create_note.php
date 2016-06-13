<?php
    require "../login/validate_session.php";
    require "../db/query_db.php";
    require "../render/page_builder.php";
    
    $userId = $_GET['UserId'];

    render_header("Edit Note", false);
    render_nav("Create Note");

?>
<div class="wrapper">
    <div class="detail_table">
        <form action="create_note_post.php" method="post">
            <table class="notetable">
                <col class="notedefs">
                <tr>
                    <td>Note Type</td>
                    <td><input class="textbox" name="note[type]" type="text"></td>
                </tr>
                <tr>
                    <td>Text</td>
                    <td><textarea class="textarea" name="note[text]"></textarea></td>
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
