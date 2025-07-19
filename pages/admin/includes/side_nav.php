<aside id="sidebar" class="sidebar shadow p-4 mb-1 bg-white rounded" style="background-color: rgb(237, 245, 252);">
    <ul class="sidebar-nav mt-3" id="sidebar-nav">
      <?php if($role == "admin"){?>
      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
        <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="add_child.php">
          <i class="bi bi-person-vcard-fill" style="color:gray"></i><span style="color:black"> Add child</span><i class="bi ms-auto"></i>
        </a>
      </li><!-- End Forms Nav --><!-- End Components Nav -->

      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
        <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="add_foster_care.php">
          <i class="bi bi-person-vcard-fill icon-100" style="color:gray"></i><span style="color:black"> Add foster care</span><i class="bi ms-auto"></i>
        </a>
      </li><!-- End Forms Nav -->

      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
        <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="add_user.php">
          <i class="bi bi-house-add-fill" style="color:gray"></i><span style="color:black"> Add user</span><i class="bi ms-auto"></i>
        </a>
      </li><!-- End Tables Nav -->

      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
      <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="allocated_children.php">
          <i class="bi bi-house-gear-fill" style="color:gray"></i><span style="color:black"> Allocated children </span><i class="bi ms-auto"></i>
        </a>
      </li><!-- End Tables Nav -->

      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
        <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="children_list.php">
          <i class="bi bi-people-fill" style="color:gray"></i><span style="color:black"> Manage children</span><i class="bi ms-auto"></i>
        </a>
      </li><!-- End Forms Nav --><!-- End Components Nav -->

      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
      <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="manage_foster_care.php">
          <i class="bi bi-pencil-square" style="color:gray"></i><span style="color:black"> Manage foster care</span><i class="bi ms-auto"></i>
        </a>
      </li><!-- End Charts Nav -->

      <li class="nav-item border shadow p-1 mb-1 bg-white rounded">
      <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="manage_user.php">
          <i class="bi bi-people" style="color:gray"></i><span style="color:black"> Manager user</span><i class="bi ms-auto"></i>
        </a>
      </li><!-- End Icons Nav -->
    </li>
    </ul>

    <?php } ?>
</aside>