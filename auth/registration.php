<!-- Font Awesome CDN (Add this in your HTML head if not already) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container py-3">
  <div class="row d-flex justify-content-center mt-1">
    <div class="col-md-7 pt-1">

      <!-- SweetAlert -->
      <?php if (isset($_SESSION['success'])): ?>
        <script>
          Swal.fire({
            icon: 'success',
            title: 'Success',
            html: '<?= $_SESSION['success'] ?>'
          });
        </script>
        <?php unset($_SESSION['success']); endif; ?>

      <?php if (isset($_SESSION['error'])): ?>
        <script>
          Swal.fire({
            icon: 'error',
            title: 'Error',
            html: '<?= $_SESSION['error'] ?>'
          });
        </script>
        <?php unset($_SESSION['error']); endif; ?>

      <div class="card shadow-lg">
        <div class="card-body text-center">
          <form action="auth/registration_action.php" method="POST" autocomplete="off">
            <div class="row mb-3">
              <div class="col-md-6 position-relative">
                <i class="fa fa-user position-absolute" style="top: 50%; left: 18px; transform: translateY(-50%); color: gray;"></i>
                <input type="text" class="form-control ps-4" name="firstname" placeholder="Enter Firstname" required>
              </div>
              <div class="col-md-6 position-relative">
                <i class="fa fa-user position-absolute" style="top: 50%; left: 18px; transform: translateY(-50%); color: gray;"></i>
                <input type="text" class="form-control ps-4" name="lastname" placeholder="Enter Lastname" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6 position-relative">
                <i class="fa fa-envelope position-absolute" style="top: 50%; left: 18px; transform: translateY(-50%); color: gray;"></i>
                <input type="email" class="form-control ps-4" name="email" placeholder="Eg. user@example.com" required>
              </div>
              <div class="col-md-6 position-relative">
                <i class="fa fa-phone position-absolute" style="top: 50%; left: 18px; transform: translateY(-50%); color: gray;"></i>
                <input type="tel" class="form-control ps-4" name="mobile" placeholder="Phone (10 digits)" pattern="[0-9]{10}" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <select name="gender" class="form-control" required>
                  <option value="">---Select Gender---</option>
                  <option value="female">Female</option>
                  <option value="male">Male</option>
                </select>
              </div>
              <div class="col-md-6">
                <input type="date" class="form-control" name="dob" placeholder="Date of Birth" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6 position-relative">
                <i class="fa fa-lock position-absolute" style="top: 50%; left: 18px; transform: translateY(-50%); color: gray;"></i>
                <input type="password" class="form-control ps-4" name="password" placeholder="Enter Password" required>
              </div>
              <div class="col-md-6 position-relative">
                <i class="fa fa-lock position-absolute" style="top: 50%; left: 18px; transform: translateY(-50%); color: gray;"></i>
                <input type="password" class="form-control ps-4" name="confirm_password" placeholder="Confirm Password" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <select name="marital_status" class="form-control" required>
                  <option value="">---Select Marital Status---</option>
                  <option value="single">Single</option>
                  <option value="married">Married</option>
                  <option value="divorced">Divorced</option>
                </select>
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <input type="checkbox" name="terms" required>
                <label class="ms-2">I accept <a href="#">terms & conditions</a></label>
              </div>
            </div>

            <div class="row mt-3 mb-2">
              <div class="col-sm-3"></div>
              <div class="col-md-6">
                <input type="submit" class="btn btn-info btn-block form-control" name="submit" value="REGISTER">
              </div>
            </div>

            <div class="form-group mt-3">
              <center>
                Already have an account? 
                <a href="login.php" style="color: dodgerblue;">Sign In</a>
              </center>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
