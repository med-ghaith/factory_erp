<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | Production System</title>
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          crossorigin="anonymous" />
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          crossorigin="anonymous" />
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="public/assets/Login&Register/style.css" />
</head>
<body>


        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <section class="section-login">
    <div class="row">
        <div class="col-xl-6">
            <img src="/public/assets/Login&Register/bg-production.jpg" class="d-none d-sm-none d-md-none d-lg-none d-xl-block" alt="">
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-mobile col-tab">
            <div class="form-login text-center">
                <div class="parent d-flex justify-content-center align-items-center" style="height: 80vh;">
                    <div class="child">
                        <form action="/login_technicien" method="post">
                            <h4>Production System</h4>
                            <h5 class="mt-3">Technicien Sign in by entering the information below</h5>
                            <div class="form-group mt-5">
                                <input type="text" class="form-control" placeholder="Matricule" name="matricule" required autofocus>
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" class="form-control" name="password" placeholder="Password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <button type="submit" class="btn btn-login bg-primary">LOGIN</button>
                            <div class="mt-3">
        <a href="/login_admin" class="btn btn-link">Admin Login</a>
    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
        // Password show/hide toggle
        $(".toggle-password").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            const input = $($(this).attr("toggle"));
            input.attr("type", input.attr("type") === "password" ? "text" : "password");
        });
    </script>

</body>

</html>