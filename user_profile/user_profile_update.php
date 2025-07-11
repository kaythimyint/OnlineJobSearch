<?php
require "../user_profile/user_header.php";

if (isset($_POST['form_sub']) && $_POST['form_sub'] == '1') {
    
}
?>
        <div class="col-12 col-lg-8 col-md-12 py-3">
            <form action="" method="POST">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body d-flex">
                                <img id="preview" src="../img/profile.jpg" alt="" style="width: 200px;height:200px;">
                                <div class="pt-5 ps-5">
                                    <label for="profile" class="profile mb-3">Selete Profile Image</label>
                                    <input type="file" name="profile" style="display: none;" id="profile">
                                    <p>Supported files are jpg,jpeg,png</p>
                                    <small class="text-danger">Error</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border mb-3" style="border-top: none !important;">
                    <!-- <div class="col-12 border"> -->
                        <div style="background-color:darkblue;padding:10px;">
                            <h3 class="text-white">Basic Information</h3>
                        </div>
                    <!-- </div> -->
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="first_name" class="mb-2">First Name</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="first_name"  id="first_name" placeholder="First Name">
                            </div>
                            <small id="emailHelp" class="form-text text-danger">error</small>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="first_name" class="mb-2">last Name</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="first_name"  id="first_name" placeholder="Last Name">
                            </div>
                            <small id="emailHelp" class="form-text text-danger">error</small>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="first_name" class="mb-2">Email</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="first_name"  id="first_name" placeholder="Email">
                            </div>
                            <small id="emailHelp" class="form-text text-danger">error</small>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="first_name" class="mb-2">Address</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="first_name"  id="first_name" placeholder="Address">
                            </div>
                            <small id="emailHelp" class="form-text text-danger">error</small>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="first_name" class="mb-2">Phone</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="first_name"  id="first_name" placeholder="Phone">
                            </div>
                            <small id="emailHelp" class="form-text text-danger">error</small>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="first_name" class="mb-2">Date of birth</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="first_name"  id="first_name" placeholder="Date of birth">
                            </div>
                            <small id="emailHelp" class="form-text text-danger">error</small>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="first_name" class="mb-2">National ID</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="first_name"  id="first_name" placeholder="National ID">
                            </div>
                            <small id="emailHelp" class="form-text text-danger">error</small>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="first_name" class="mb-2">Education</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="first_name"  id="first_name" placeholder="Education">
                            </div>
                            <small id="emailHelp" class="form-text text-danger">error</small>
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <input type="hidden" name="form_sub" value="1">
                        <button type="submit" class="btn btn-lg btn-warning text-light px-4 py-3"><i class="fa-solid fa-arrow-up-from-bracket"></i> Update CV</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
  const fileInput = document.getElementById("profile");
  const preview = document.getElementById("preview");

  fileInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();

      reader.addEventListener("load", function () {
        preview.src = reader.result;
      });

      reader.readAsDataURL(file);
    }
  });
</script>
<?php
require "../user_profile/user_footer.php";
?>