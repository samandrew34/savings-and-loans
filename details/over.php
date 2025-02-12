


              <?php

require_once 'config/connection.php'; // Medoo connection

// Fetch total deposit amount
$totalDeposit = $database->sum("main_deposit", "amount");

// Fetch total customers count
$totalCustomers = $database->count("customerdata");

// Fetch count of verified and unverified customers
$verifiedCustomers = $database->count("customerdata", ["verification" => 1]);
$unverifiedCustomers = $database->count("customerdata", ["verification" => 0]);
?>

<div class="row g-6 mb-6">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Deposit</span>
                        <span class="h3 font-bold mb-0">$<?= number_format($totalDeposit, 2) ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                            <i class="bi bi-credit-card"></i>
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-0 text-sm">
                    <span class="badge badge-pill bg-soft-success text-success me-2">
                        <i class="bi bi-arrow-up me-1"></i>
                    </span>
                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Customers</span>
                        <span class="h3 font-bold mb-0"><?= $totalCustomers ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-0 text-sm">
                    <span class="badge badge-pill bg-soft-success text-success me-2">
                        <i class="bi bi-arrow-up me-1"></i>80%
                    </span>
                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Verified Customers</span>
                        <span class="h3 font-bold mb-0"><?= number_format($verifiedCustomers) ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                            <i class="bi bi-clock-history"></i>
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-0 text-sm">
                    <span class="badge badge-pill bg-soft-danger text-danger me-2">
                        <i class="bi bi-arrow-down me-1"></i>-5%
                    </span>
                    <span class="text-nowrap text-xs text-muted">Unverified Customers</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Unverified Customers</span>
                        <span class="h3 font-bold mb-0"><?= number_format($unverifiedCustomers) ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                            <i class="bi bi-minecart-loaded"></i>
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-0 text-sm">
                    <span class="badge badge-pill bg-soft-success text-success me-2">
                        <i class="bi bi-arrow-up me-1"></i>10%
                    </span>
                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                </div>
            </div>
        </div>
    </div>
</div>



              <style>
        .card {
            height: 100%; /* Ensures equal height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .icon-shape {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

