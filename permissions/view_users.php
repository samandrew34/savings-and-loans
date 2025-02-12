<?php
// Ensure the session is started only once
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userid'])) {
    header("Location: signin.php");
    exit();
}

require '../config/connection.php'; // Ensure database connection

$userid = $_SESSION['userid'];
$role = $_SESSION['role'] ?? '';

if (empty($role)) {
    die("Role is not set correctly.");
}

// Fetch menu items using Medoo
$menus = $database->select("permit", [
    "menu_head",
    "dropdown_item",
    "hide_menu",
    "hide_dropdown",
    "visible_to_user_ids",
    "visible_to_all",
    "visible_to_one",
    "show_to_specific_ids",
    "links"
], [
    "role" => $role,
    "hide_menu" => 0
]);

// Initialize menu array
$menu = [];

foreach ($menus as $row) {
    $visible_to_user_ids = !empty($row['visible_to_user_ids']) ? explode(',', $row['visible_to_user_ids']) : [];
    $show_to_specific_ids = !empty($row['show_to_specific_ids']) ? explode(',', $row['show_to_specific_ids']) : [];
    $visible_to_all = $row['visible_to_all'];
    $visible_to_one = $row['visible_to_one'];
    $links = $row['links'];

    $is_visible = true;

    if ($visible_to_all == 1) {
        $is_visible = false;
    }

    if ($visible_to_one == 0 && in_array($userid, $visible_to_user_ids)) {
        $is_visible = false;
    }

    if (!empty($show_to_specific_ids) && !in_array($userid, $show_to_specific_ids)) {
        $is_visible = false;
    }

    if ($is_visible) {
        if (!isset($menu[$row['menu_head']])) {
            $menu[$row['menu_head']] = [];
        }
        if ($row['hide_dropdown'] == 0) {
            $menu[$row['menu_head']][] = ['item' => $row['dropdown_item'], 'links' => $links];
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>okru</title>
    <link rel="stylesheet" href="../style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css"
      rel="stylesheet"
    />  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="users/users.js"></script>
  </head>
  <body>
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
      <nav
        class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg"
        id="navbarVertical"
      >
        <div class="container-fluid">
          <button
            class="navbar-toggler ms-n2"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#sidebarCollapse"
            aria-controls="sidebarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
            <h3 class="text-success">
              <!-- <img src="https://bytewebster.com/img/logo.png" width="40" /><span
                class="text-info"
                > --> OKRU  MICRO-CREDIT</span
              >
            </h3>
          </a>
          <div class="navbar-user d-lg-none">
            <div class="dropdown">
              <a
                href="#"
                id="sidebarAvatar"
                role="button"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <div class="avatar-parent-child">
                  <img
                    alt="Image Placeholder"
                    src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                    class="avatar avatar- rounded-circle"
                  />
                  <span class="avatar-child avatar-badge bg-success"></span>
                </div>
              </a>
              <div
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="sidebarAvatar"
              >
                <a href="#" class="dropdown-item">Fullname</a>
                <a href="#" class="dropdown-item">Workid</a>
                <a href="#" class="dropdown-item">Billing</a>
                <hr class="dropdown-divider" />
                <a href="#" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
      



      <?php include 'menu/sidebar.php'; ?>
        </div>
      </nav>
      <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <header class="bg-surface-primary border-bottom pt-6">
          <div class="container-fluid">
            <div class="mb-npx">
              <div class="row align-items-center">
                <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                  <h1 class="h2 mb-0 ls-tight">
                    <!-- <img
                      src="https://bytewebster.com/img/logo.png"
                      width="40"
                    /> -->
                    OKRU MICRO-CREDIT
                  </h1>
                </div>
                <div class="col-sm-6 col-12 text-sm-end">
                  <div class="mx-n1">
                    <a
                      href="#"
                      class="btn d-inline-flex btn-sm btn-neutral border-base mx-1"
                    >
                      <span class="pe-2">
                        <i class="bi bi-pencil"></i>
                      </span>
                      <span>Edit</span>
                    </a>
                    <a
                      href="#"
                      class="btn d-inline-flex btn-sm btn-primary mx-1"
                    >
                      <span class="pe-2">
                        <i class="bi bi-plus"></i>
                      </span>
                      <span>Create</span>
                    </a>
                    <a
                      href="#"
                      class="btn d-inline-flex btn-sm btn-warning mx-1"
                    >
                      <span class="pe-2">
                        <i class="bi bi-gear-wide-connected"></i>
                      </span>
                      <span>Manage</span>
                    </a>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs mt-4 overflow-x border-0">
                <li class="nav-item">
                  <a href="#" class="nav-link active">All files</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link font-regular">Shared</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link font-regular">File requests</a>
                </li>
              </ul>
            </div>
          </div>
        </header>
        <main class="py-6 bg-surface-secondary">
          <div class="container-fluid">
      


          <?php include 'details/over.php'; ?>
           
          <div class="card shadow border-0 mb-7">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Users on The System</h5>
    <!-- Add Button moved to the right -->
    <button type="button" class="btn btn-sm btn-square btn-neutral text-success-hover ms-auto">
      <i class="bi bi-plus-circle"></i>
    </button>
  </div>


              <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
<div class="table-responsive" style="max-height: calc(10 * 60px); overflow-y: auto;">

  <table class="table table-hover table-nowrap" id="searchableTable">
    <!-- <thead class="thead-light"> -->
    <thead class="thead-light position-sticky" style="top: 0; background-color: #f8f9fa; z-index: 1;">
      <tr>
        <th scope="col">Fullname</th>
        <th scope="col">Workid</th>
        <th scope="col">Userid</th>
        <th scope="col">Role</th>
        <th scope="col">status</th>
        <th>
        <input
    type="text"
    id="searchInput"
    class="form-control w-25"
    placeholder="Search table..."
    onkeyup="filterTable()"
  />
                </th>
      </tr>
    </thead>
    <tbody>
                  
                  
                  
                  
                
                  
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="../asset/users/user.jpg"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Emily Davis
                        </a>
                      </td>
                      <td>Feb 15, 2023</td>
                      <td>
                       
                        <a class="text-heading font-semibold" href="#">
                          Mailchimp
                        </a>
                      </td>
                      <td>$3.500</td>
                      <td>
                        <span class="badge badge-lg badge-dot">
                          <i class="bg-dark"></i>Not discussed
                        </span>
                      </td>
                   

                      <td class="text-end">
    <!-- Add Button -->
    <button type="button" class="btn btn-sm btn-square btn-neutral text-success-hover">
        <i class="bi bi-plus-circle"></i>
    </button>

    <!-- View Button -->
    <button type="button" class="btn btn-sm btn-square btn-neutral text-info-hover">
        <i class="bi bi-eye"></i>
    </button>

    <!-- Edit Button -->
    <button type="button" class="btn btn-sm btn-square btn-neutral text-primary-hover">
        <i class="bi bi-pencil-square"></i>
    </button>

    <!-- Delete Button -->
    <button type="button" onclick="showSweetAlert()" class="btn btn-sm btn-square btn-neutral text-danger-hover">
        <i class="bi bi-trash"></i>
    </button>
</td>


                    </tr>
                   
                  </tbody>
  </table>
              </div>
          





              <div class="card-footer border-0 py-5">
                <span class="text-muted text-sm"
                  >Showing 10 items out of 250 results found</span
                >
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link disabled" href="#">Previous</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link bg-info text-white" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">Next</a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  function filterTable() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("searchableTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
      const cells = rows[i].getElementsByTagName("td");
      let match = false;

      for (let j = 0; j < cells.length; j++) {
        const cellContent = cells[j].textContent || cells[j].innerText;
        if (cellContent.toLowerCase().indexOf(filter) > -1) {
          match = true;
          break;
        }
      }

      rows[i].style.display = match ? "" : "none";
    }
  }
</script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <script src="script.js"></script>
  </body>
</html>
