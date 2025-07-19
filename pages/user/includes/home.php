<main class="main" id="main">
  <section class="section dashboard">
  <?php if ($role == "admin" || $role == "parent") {?> 
    <div class="row" style="margin-top:15px">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card info-card  shadow mb-3 rounded">
        <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body">
                  <h3 class="pt-3 ps-3" style="color:#004e64"><strong><?php echo $count_fostercare ?></h3></strong>
                  <span style="color:" class="ps"><strong>Foster care</strong></span>
                </div>
                <div class="card-icon  d-flex align-items justify-content mt-2 mr-4">
                <i class="fa fa-home fa-2x pt-3 ps-3" style="color:#004e64"></i>
                </div>
              </div>
            </div>
          </div>
      </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card info-card customer-card shadow mb-3 rounded">
        <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body ml-2">
                  <h3 class="pt-3 ps-3 rounded-circle" style="color:orange"><strong><?php echo $count_child ?></h3></strong>
                  <span style="color:black" class="ps-"><strong>Total Children</strong></span>
                </div>
                <div class="card-icon  d-flex align-items justify-content mt-2 mr-4">
                <i class="fa fa-child fa-2x pt-3 ps-3" style="color:orange"></i>
                </div>
              </div>
            </div>
          </div>
      </div>
      </div>
      <?php } ?>
      <?php if($role == "admin"){?>
        <div class="col-xl-3 col-sm-6 col-12">
        <div class="card info-card customer-card shadow mb-3 g-white rounded">
        <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body ml-2">
                  <h3 class="pt-3 ps-3" style="color:#7f7b82"><strong><?php echo $count_user ?></h3></strong>
                  <span style="color:" class="ps"><strong>Total Users</strong></span>
                </div>
                <div class="card-icon  d-flex align-items justify-content mt-2 mr-4">
                <i class="fa fa-users fa-2x pt-2 ps-3" style="color:#7f7b82"></i>
                </div>
              </div>
            </div>
          </div>
      </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card info-card customer-card shadow mb-3 g-white rounded">
        <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body ml-2">
                  <h3 class="pt-3 ps-3" style="color:#f49cbb"><strong>16</h3></strong>
                  <span style="color:" class="ps"><strong>Total visits</strong></span>
                </div>
                <div class="card-icon  d-flex align-items justify-content mt-2 mr-4">
                <i class="fa fa-globe fa-2x pt-3 ps-3" style="color:#f49cbb"></i>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <?php } ?>
  </section>
</main>


