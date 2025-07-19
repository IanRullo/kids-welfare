
  <aside id="sidebar" class="sidebar shadow p-4 mb-1 bg-white rounded" style="background-color: rgb(237, 245, 252);">
    <!--parent-session-->
    <?php if($role == "parent"){?>
    <ul class="sidebar-nav mt-3" id="sidebar-nav">
      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
      <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="adoption_application.php">
          <i class="bi bi-files" style="color:blue"></i><span style="color:black"> Adoption Application</span><i class="bi ms-auto"></i>
        </a>
      </li><!-- End Tables Nav -->
      </li><!-- End Tables Nav -->
      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
      <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="allocated_children.php">
          <i class="bi bi-people-fill" style="color:blue"></i><span style="color:black"> Children</span><i class="bi ms-auto"></i>
        </a>
      </li><!-- End Tables Nav -->
      </li><!-- End Tables Nav -->
      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="" href="forstercare.php">
          <i class="bi bi-house-gear-fill" style="color:blue"></i><span style="color:black"> Fostercare</span><i class="bi ms-auto"></i>
        </a>
      </li>
      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="" href="manage_request.php">
          <i class="bi bi-bell" style="color:blue"></i><span style="color:black"> Manage request</span><i class="bi ms-auto"></i>
        </a>
      </li>
      <?php } ?>
      <!--parent session end-->
    </ul>
  </aside>