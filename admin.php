

<?php
session_start();
require 'config/config.php';

// Redirect if not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: signin.php");
    exit();
}

// Fetch permissions for the logged-in user
$userid = $_SESSION['userid'];
$role = $_SESSION['role'];

// Check if role is valid
if (empty($role)) {
    die("Role is not set correctly.");
}

// Modified query to account for the visibility columns
$stmt = $conn->prepare("
    SELECT menu_head, dropdown_item, hide_menu, hide_dropdown, visible_to_user_ids, visible_to_all, visible_to_one, show_to_specific_ids, links
    FROM permit 
    WHERE role = ? AND hide_menu = 0
");

if ($stmt === false) {
    die("Failed to prepare the statement: " . $conn->error);
}

$stmt->bind_param("s", $role);
$stmt->execute();
$result = $stmt->get_result();

// Initialize menu array
$menu = [];
while ($row = $result->fetch_assoc()) {
    // Extract visibility data
    $visible_to_user_ids = $row['visible_to_user_ids'] ? explode(',', $row['visible_to_user_ids']) : [];
    $show_to_specific_ids = $row['show_to_specific_ids'] ? explode(',', $row['show_to_specific_ids']) : [];
    $visible_to_all = $row['visible_to_all'];
    $visible_to_one = $row['visible_to_one'];
    $links = $row['links']; // Get the link from the database

    // Determine visibility
    $is_visible = true;

    // If visible_to_all is 1, hide the menu from all users
    if ($visible_to_all == 1) {
        $is_visible = false;
    }

    // If visible_to_one is 0, hide the menu for this specific user
    if ($visible_to_one == 0 && in_array($userid, $visible_to_user_ids)) {
        $is_visible = false;
    }

    // Check if the user is in the `show_to_specific_ids` list
    if (!empty($show_to_specific_ids) && !in_array($userid, $show_to_specific_ids)) {
        $is_visible = false;
    }

    // If the menu is still visible, add it to the $menu array
    if ($is_visible) {
        if (!isset($menu[$row['menu_head']])) {
            $menu[$row['menu_head']] = [];
        }
        if ($row['hide_dropdown'] == 0) {
            // Add the link along with the item name
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
    <link rel="stylesheet" href="./style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css"
      rel="stylesheet"
    />  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
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
              <img src="https://bytewebster.com/img/logo.png" width="40" /><span
                class="text-info"
                >BYTE</span
              >WEBSTER
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
                    <img
                      src="https://bytewebster.com/img/logo.png"
                      width="40"
                    />
                    ByteWebster Application
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
            <div class="row g-6 mb-6">
              <div class="col-xl-3 col-sm-6 col-12">
                <div class="card shadow border-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <span
                          class="h6 font-semibold text-muted text-sm d-block mb-2"
                          >Budget</span
                        >
                        <span class="h3 font-bold mb-0">$11590.90</span>
                      </div>
                      <div class="col-auto">
                        <div
                          class="icon icon-shape bg-tertiary text-white text-lg rounded-circle"
                        >
                          <i class="bi bi-credit-card"></i>
                        </div>
                      </div>
                    </div>
                    <div class="mt-2 mb-0 text-sm">
                      <span
                        class="badge badge-pill bg-soft-success text-success me-2"
                      >
                        <i class="bi bi-arrow-up me-1"></i>37%
                      </span>
                      <span class="text-nowrap text-xs text-muted"
                        >Since last month</span
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 col-12">
                <div class="card shadow border-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <span
                          class="h6 font-semibold text-muted text-sm d-block mb-2"
                          >New projects</span
                        >
                        <span class="h3 font-bold mb-0">320</span>
                      </div>
                      <div class="col-auto">
                        <div
                          class="icon icon-shape bg-primary text-white text-lg rounded-circle"
                        >
                          <i class="bi bi-people"></i>
                        </div>
                      </div>
                    </div>
                    <div class="mt-2 mb-0 text-sm">
                      <span
                        class="badge badge-pill bg-soft-success text-success me-2"
                      >
                        <i class="bi bi-arrow-up me-1"></i>80%
                      </span>
                      <span class="text-nowrap text-xs text-muted"
                        >Since last month</span
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 col-12">
                <div class="card shadow border-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <span
                          class="h6 font-semibold text-muted text-sm d-block mb-2"
                          >Total hours</span
                        >
                        <span class="h3 font-bold mb-0">4.100</span>
                      </div>
                      <div class="col-auto">
                        <div
                          class="icon icon-shape bg-info text-white text-lg rounded-circle"
                        >
                          <i class="bi bi-clock-history"></i>
                        </div>
                      </div>
                    </div>
                    <div class="mt-2 mb-0 text-sm">
                      <span
                        class="badge badge-pill bg-soft-danger text-danger me-2"
                      >
                        <i class="bi bi-arrow-down me-1"></i>-5%
                      </span>
                      <span class="text-nowrap text-xs text-muted"
                        >Since last month</span
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 col-12">
                <div class="card shadow border-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <span
                          class="h6 font-semibold text-muted text-sm d-block mb-2"
                          >Work load</span
                        >
                        <span class="h3 font-bold mb-0">88%</span>
                      </div>
                      <div class="col-auto">
                        <div
                          class="icon icon-shape bg-warning text-white text-lg rounded-circle"
                        >
                          <i class="bi bi-minecart-loaded"></i>
                        </div>
                      </div>
                    </div>
                    <div class="mt-2 mb-0 text-sm">
                      <span
                        class="badge badge-pill bg-soft-success text-success me-2"
                      >
                        <i class="bi bi-arrow-up me-1"></i>10%
                      </span>
                      <span class="text-nowrap text-xs text-muted"
                        >Since last month</span
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card shadow border-0 mb-7">
              <div class="card-header">
                <h5 class="mb-0">Applications</h5>
              </div>
              <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
<div class="table-responsive" style="max-height: calc(10 * 60px); overflow-y: auto;">

  <table class="table table-hover table-nowrap" id="searchableTable">
    <!-- <thead class="thead-light"> -->
    <thead class="thead-light position-sticky" style="top: 0; background-color: #f8f9fa; z-index: 1;">
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Date</th>
        <th scope="col">Company</th>
        <th scope="col">Offer</th>
        <th scope="col">Meeting</th>
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
                          src="https://images.unsplash.com/photo-1610271340738-726e199f0258?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Ashley Williams
                        </a>
                      </td>
                      <td>Apr 15, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-2.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Netguru
                        </a>
                      </td>
                      <td>$2.750</td>
                      <td>
                        <span class="badge badge-lg badge-dot">
                          <i class="bg-warning"></i>Postponed
                        </span>
                      </td>
                      <td class="text-end">
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1610878722345-79c5eaf6a48c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Melissa Chen
                        </a>
                      </td>
                      <td>Mar 20, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-3.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Figma
                        </a>
                      </td>
                      <td>$4.200</td>
                      <td>
                        <span class="badge badge-lg badge-dot">
                          <i class="bg-success"></i>Scheduled
                        </span>
                      </td>
                      <td class="text-end">
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1612422656768-d5e4ec31fac0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Emily Davis
                        </a>
                      </td>
                      <td>Feb 15, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-4.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
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
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1608976328267-e673d3ec06ce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Thomas Nguyen
                        </a>
                      </td>
                      <td>Apr 10, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-5.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Webpixels
                        </a>
                      </td>
                      <td>$1.500</td>
                      <td>
                        <span class="badge badge-lg badge-dot">
                          <i class="bg-danger"></i>Canceled
                        </span>
                      </td>
                      <td class="text-end">
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1610271340738-726e199f0258?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Ashley Williams
                        </a>
                      </td>
                      <td>Apr 15, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-2.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Netguru
                        </a>
                      </td>
                      <td>$2.750</td>
                      <td>
                        <span class="badge badge-lg badge-dot">
                          <i class="bg-warning"></i>Postponed
                        </span>
                      </td>
                      <td class="text-end">
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1610878722345-79c5eaf6a48c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Melissa Chen
                        </a>
                      </td>
                      <td>Mar 20, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-3.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Figma
                        </a>
                      </td>
                      <td>$4.200</td>
                      <td>
                        <span class="badge badge-lg badge-dot">
                          <i class="bg-success"></i>Scheduled
                        </span>
                      </td>
                      <td class="text-end">
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1612422656768-d5e4ec31fac0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Emily Davis
                        </a>
                      </td>
                      <td>Feb 15, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-4.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
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
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1608976328267-e673d3ec06ce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Thomas Nguyen
                        </a>
                      </td>
                      <td>Apr 10, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-5.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Webpixels
                        </a>
                      </td>
                      <td>$1.500</td>
                      <td>
                        <span class="badge badge-lg badge-dot">
                          <i class="bg-danger"></i>Canceled
                        </span>
                      </td>
                      <td class="text-end">
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1610271340738-726e199f0258?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Ashley Williams
                        </a>
                      </td>
                      <td>Apr 15, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-2.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Netguru
                        </a>
                      </td>
                      <td>$2.750</td>
                      <td>
                        <span class="badge badge-lg badge-dot">
                          <i class="bg-warning"></i>Postponed
                        </span>
                      </td>
                      <td class="text-end">
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1610878722345-79c5eaf6a48c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Melissa Chen
                        </a>
                      </td>
                      <td>Mar 20, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-3.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Figma
                        </a>
                      </td>
                      <td>$4.200</td>
                      <td>
                        <span class="badge badge-lg badge-dot">
                          <i class="bg-success"></i>Scheduled
                        </span>
                      </td>
                      <td class="text-end">
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1612422656768-d5e4ec31fac0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Emily Davis
                        </a>
                      </td>
                      <td>Feb 15, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-4.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
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
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img
                          alt="..."
                          src="https://images.unsplash.com/photo-1608976328267-e673d3ec06ce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                          class="avatar avatar-sm rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Thomas Nguyen
                        </a>
                      </td>
                      <td>Apr 10, 2023</td>
                      <td>
                        <img
                          alt="..."
                          src="https://preview.webpixels.io/web/img/other/logos/logo-5.png"
                          class="avatar avatar-xs rounded-circle me-2"
                        />
                        <a class="text-heading font-semibold" href="#">
                          Webpixels
                        </a>
                      </td>
                      <td>$1.500</td>
                      <td>
                        <span class="badge badge-lg badge-dot">
                          <i class="bg-danger"></i>Canceled
                        </span>
                      </td>
                      <td class="text-end">
                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                        <button
                          type="button"
                          onclick="showSweetAlert()"
                          class="btn btn-sm btn-square btn-neutral text-danger-hover"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
