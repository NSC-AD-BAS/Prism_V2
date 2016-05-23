<?php
    require "query_db.php";
    require "../render/page_builder.php";

    $noteId = $_GET['id'];
    $note = get_note($noteId);
    
    $userId = $note['UserId'];

    render_header("Edit Note", false);
    render_nav("Edit Note");

?>
<div class="wrapper">
    <div class="detail_table">
        <form action="edit_note_post.php" method="post">
            <table>
                <tr>
                    <td>Note Type</td>
                    <td><input class="textbox" name="note[type]" type="text" value="<?=$note["Type"]?>"></td>
                </tr>
                <tr>
                    <td>Text</td>
                    <td><input class="textbox" name="note[text]" type="text" value="<?=$note["Text"]?>"></td>
                </tr>
                <input type="hidden" name="note[id]" value="<?=$noteId?>">
                <input type="hidden" name="note[UserId]" value="<?=$userId?>">
            </table>
            <hr>
            <div>
                <input class="form_button" type="submit" value="Save">
                <a class="button" href="detail.php?id=<?=$userId?>"><div>Cancel</div></a>
            </div>
        </form>
        
    </div>
</div>

<?php render_footer(); ?>
