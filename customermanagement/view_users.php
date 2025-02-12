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
    
    <!-- jQuery (For AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
 

    <!-- jQuery & SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <style>
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
        }
        .popup-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .popup-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    </style>
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
                <a href="#" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Settings</a>
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
      


            
           
         
            <div class="card shadow border-0 mb-7">
              <div class="card-header">
               
             
              <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Applications</h5>
    <!-- Add Button moved to the right -->
   
    
    <?php
// Start the session


// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'savings_db';

// Establish the connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8
$conn->set_charset("utf8");

// Ensure the user is logged in and get the session user ID
if (!isset($_SESSION['userid'])) {
    die('<p class="text-danger">User not logged in</p>');
}

$userid = $_SESSION['userid']; // Get logged-in user ID from session

// Fetch the button data for "Add" where id = 1
$sql = "SELECT * FROM customerbuttons WHERE id = 1";
$result = $conn->query($sql);

$showButton = false; // Default: Don't show the button

if ($result->num_rows > 0) {
    $button = $result->fetch_assoc();
    $buttonStatus = $button['buttonstatus'];
    $activeIds = explode(',', $button['activeids']);  // Convert active IDs to an array
    $inactiveIds = explode(',', $button['inactiveids']); // Convert inactive IDs to an array

    // Check if the button should be displayed
    if (
        $buttonStatus == 1 && // Button must be active
        in_array($userid, $activeIds) && // User must be in activeIds
        !in_array($userid, $inactiveIds) // User must NOT be in inactiveIds
    ) {
        $showButton = true; // Allow button display
    }
}

// Close the database connection
$conn->close();
?>

<?php if ($showButton): ?>
            <button type="button" class="btn btn-sm btn-square btn-neutral text-success-hover ms-auto">
                <i class="bi bi-plus-circle"></i> 
            </button>
        <?php else: ?>
            <p class="text-danger">Restricted</p>
        <?php endif; ?>

    <!-- <button type="button" class="btn btn-sm btn-square btn-neutral text-success-hover ms-auto">
      <i class="bi bi-plus-circle"></i>no
    </button>  -->
  </div>
              <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
<div class="table-responsive" style="max-height: calc(10 * 60px); overflow-y: auto;">

  <table class="table table-hover table-nowrap" id="searchableTable">
    <!-- <thead class="thead-light"> -->
    <thead class="thead-light position-sticky" style="top: 0; background-color: #f8f9fa; z-index: 1;">
      <tr>
        <th scope="col">Fullname</th>
        <th scope="col">customerid</th>
        <th scope="col">customernumber</th>
        <th scope="col">email</th>
        <th scope="col">location</th>
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
    </thead>
        <tbody>
            <!-- Dynamic Data will be inserted here -->
        </tbody>
    </table>

                

              </div>



              <script src="customers.js"></script>
             

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
<!-- Custom Popup for Viewing Customer Details -->

    
<div id="viewPopup" class="popup-overlay">
    <div class="popup-card">
        <img id="popupImage" alt="Customer">
        <h4 id="popupName" class="fw-semibold"></h4>
        <p id="popupEmail" class="text-muted"></p>
        <button onclick="closePopup()" class="btn btn-danger">Close</button>
    </div>
</div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <script src="customers.js"></script>
  </body>
</html>
