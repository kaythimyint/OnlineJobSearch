<?php
require "./user_header.php";

$error = false;
$education =
$education_error ='';

if (isset($_POST['form_sub']) && $_POST['form_sub'] == '1') {
    $education = $mysqli->real_escape_string($_POST['education']);

    if (strlen($education) == 0) {
        $error = true;
        $education_error  = "Education is require";
    } else if (strlen($education) <= 2) {
        $error = true;
        $education_error  = "Education greater than 2 character.";
    } else if (strlen($education) >= 30) {
        $error = true;
        $education_error  = "Education less than 30 character.";
    }

    if (!$error) {
        $data = [
            'education' => $education
        ];
        $where =[
            'id' => $id
        ];
        $update_res = updateData('users',$mysqli,$data,$where);

        if ($update_res) {
           echo "<script>window.location.href = 'index.php?success=Education update success';</script>";
        }
    }
}
?>
        <div class="col-12 col-lg-8 col-md-12 pb-3">
            <div style="background-color:darkblue;padding:10px;">
                <h3 class="text-white">Education</h3>
            </div>
            <form action="" method="POST">
                <div class="col-12 border p-3">
                    <div class="form-group py-3">
                        <label for="education" class="mb-2">Level of education</label>
                        <div class="d-flex user_input">
                            <i class="fas fa-book-open me-2" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                            <input type="text" class="form-control border-0 user_inputbox" name="education" value="<?= !empty($data['education']) ? $data['education']: $education ?>" id="education" placeholder="Level of education">
                        </div>
                        <?php
                            if ($education_error && $error) { ?>
                                <small class="form-text text-danger"><?= $education_error ?></small>
                        <?php
                        }
                        ?>
                    </div>
                    <input type="hidden" name="form_sub" value="1">
                    <button type="submit" class="btn btn-primary w-100">ADD</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require "./user_footer.php";
?>