<?php
require "./common/url.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/regular.min.css">
    <script src="./js/jquery.min.js"></script>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-height: 100%;
            overflow-x: hidden;
        }

        input[type=email]::placeholder,
        input[type=password]::placeholder {
            color: white;
        }

        section {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
        }

        section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-image: url('./img/teamworks.png');
            /* 👈 adjust path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(4px) brightness(0.8);
            z-index: -1;
        }

        section * {
            position: relative;
            z-index: 1;
        }


        @media (min-width: 992px) {
            .min-vh-lg-100 {
                min-height: 100vh !important;
            }
        }

        .user:hover,
        .employer:hover {
            border-color: gold !important;
            color: gold !important;
            background-color: #010167;
            font-size: 15pt;
        }
    </style>
</head> 
<body>
    <section>
        <div class="row flex-column-reverse flex-lg-row m-0">
            <div class="col-12 col-lg-5 d-flex justify-content-center align-items-start align-items-lg-center min-vh-lg-100"
                style="background-color: darkblue;padding-top: 20px;">
                <form action="" style="width:80%;margin:auto;padding-top:20px" class="user_login">
                                <div class="form-group mb-3">
                                    <label for="email" class="text-light fw-bold mb-2">Email</label>
                                    <div class="d-flex border border-info rounded">
                                        <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                        <input type="email" class="form-control" style="background-color: inherit;border:none" id="email" placeholder="User Email">
                                    </div>
                                    <small id="emailHelp" class="form-text text-danger">Email Invalid</small>
                                </div>
                                <div class="form-group mb-5">
                                    <label for="email" class="text-light fw-bold mb-2">Email</label>
                                    <div class="d-flex border border-info rounded">
                                        <i class="fa-solid fa-key" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                        <input type="password" class="form-control" style="background-color: inherit;border:none" id="email" placeholder="Enter Password">
                                    </div>
                                    <small id="emailHelp" class="form-text text-danger">Email Invalid</small>
                                </div>
                                <input type="hidden" name="form_type" value="user" />
                                <button type="submit" style="background-color:gold" class="btn btn-lg w-100 text-light">Login</button>
                                <div class="d-flex justify-content-center mt-5">
                                    <h5 class="text-light">New to Join? </h5>
                                    <a href="<?php echo $base_url . "register.php" ?>" style="color: gold;text-decoration:none"> Create an account</a>
                                </div>
                            </form>
            </div>
            <div class="col-12 col-lg-7 d-flex justify-content-center align-items-center min-vh-lg-100 py-5">
                <div class="">
                    <h1 class="text-white pb-3">Welcome To</h1>
                    <img src="./img/logo.jpg" alt="" style="width: 180px;height:180px;border-radius:50%">
                </div>
            </div>
        </div>
    </section>
</body>
</html>