<?php
require "./user_header.php";

$error = false;
$skill =
$skill_error =
$language =
$language_error ='';

if (isset($_POST['form_sub']) && $_POST['form_sub'] == '1') {
    $language = $mysqli->real_escape_string($_POST['language']);
    $skill = $mysqli->real_escape_string($_POST['skill']);

    //language vala
    if (strlen($language) == 0) {
        $error = true;
        $language_error  = "Language is require";
    } else if (strlen($language) <= 3) {
        $error = true;
        $language_error  = "Language greater than 3 character.";
    } else if (strlen($language) >= 30) {
        $error = true;
        $language_error  = "Language less than 30 character.";
    }

    if (strlen($skill) == 0) {
        $error = true;
        $skill_error  = "Skill is require";
    } else if (strlen($skill) < 3) {
        $error = true;
        $skill_error  = "Skill greater than 3 character.";
    } else if (strlen($skill) >= 30) {
        $error = true;
        $skill_error  = "Skill less than 30 character.";
    }

    if (!$error) {
        $data = [
            'language' => $language,
            'skill'   => $skill
        ];
        $where =[
            'id' => $id
        ];
        $update_res = updateData('users',$mysqli,$data,$where);

        if ($update_res) {
           echo "<script>window.location.href = 'index.php?success=Skill update success';</script>";
        }
    }
}
?>
        <div class="col-12 col-lg-8 col-md-12 pb-3">
            <div style="background-color:darkblue;padding:10px;">
                <h3 class="text-white">Skill & Language</h3>
            </div>
            <form action="" method="POST">
                <div class="col-12 border p-3 shadow">
                    <div class="form-group py-3">
                        <label for="language" class="mb-2">Language</label>
                        <div class="d-flex user_input">
                            <input type="text" class="form-control border-0 user_inputbox" name="language" value="<?= !empty($data['language']) ? $data['language']: $language ?>" id="language" placeholder="Language">
                        </div>
                        <?php
                            if ($language_error && $error) { ?>
                                <small class="form-text text-danger"><?= $language_error ?></small>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="form-group py-3">
                        <label for="skill" class="mb-2">Skill</label>
                        <div class="d-flex user_input">
                            <input type="text" class="form-control border-0 user_inputbox" name="skill" value="<?= !empty($data['skill']) ? $data['skill']: $skill ?>" id="skill" placeholder="Skill">
                        </div>
                        <?php
                            if ($skill_error && $error) { ?>
                                <small class="form-text text-danger"><?= $skill_error ?></small>
                        <?php
                        }
                        ?>
                    </div>
                    <input type="hidden" name="form_sub" value="1">
                    <button type="submit" class="btn btn-primary w-100 mt-2">ADD</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require "./user_footer.php";
?>