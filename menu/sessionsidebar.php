

<!-- Sidebar -->
<nav id="sidebar" class="bg-dark text-white position-fixed vh-100" style="width: 250px;">
    <div class="sidebar-header p-3">
        <h4>Menu</h4>
    </div>
    <ul class="nav flex-column p-2">
        <li class="nav-item">
            <a class="nav-link text-white" href="dashboard.php">
                <i class="bi bi-house"></i> Dashboard
            </a>
        </li>

        <?php foreach ($menu as $menu_head => $dropdown_items): ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" data-toggle="dropdown">
                <i class="bi bi-people"></i> <?= htmlspecialchars($menu_head); ?>
            </a>

            <?php if (!empty($dropdown_items)): ?>
            <div class="dropdown-menu">
                <?php foreach ($dropdown_items as $item): ?>
                <a class="dropdown-item" href="<?= htmlspecialchars($item['links']); ?>">
                    <?= htmlspecialchars($item['item']); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>

        <li class="nav-item">
            <a class="nav-link text-white" href="signout.php">
                <i class="bi bi-box-arrow-right"></i> Signout
            </a>
        </li>
    </ul>
</nav>

<!-- Adjust the page content -->
<style>
    #sidebar {
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        padding-top: 20px;
        overflow-y: auto;
    }
</style>
