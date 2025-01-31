      
 <div class="collapse navbar-collapse" id="sidebarCollapse">
    <a href="#" class="dropdown-item"><?= htmlspecialchars($_SESSION['fullname']); ?></a>
    <a href="#" class="dropdown-item"><?= htmlspecialchars($_SESSION['email']); ?></a>
    <a href="#" class="dropdown-item"><?= htmlspecialchars($_SESSION['role']); ?></a>
      
        <ul class="navbar-nav w-100">
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-house"></i> Dashboard</a>
          </li> 
        <?php foreach ($menu as $menu_head => $dropdown_items): ?>
       
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="clientsMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bi bi-people"></i><?= htmlspecialchars($menu_head); ?>
            </a> <?php if (!empty($dropdown_items)): ?>
            <div class="dropdown-menu" aria-labelledby="clientsMenu">
            <?php foreach ($dropdown_items as $item): ?>
              <a class="dropdown-item"href="<?= htmlspecialchars($item['links']); ?>" class="text-white hover:underline">
              <?= htmlspecialchars($item['item']); ?>
                    </a>
                  
              <?php endforeach; ?>
            </div>

           <?php endif; ?>
          </li>
        <?php endforeach; ?>
         

    
         
        <!-- <li class="nav-item">
            <a class="nav-link" href="logout"><i class="bi bi-signout"></i> Signout</a>
          </li>  -->

          <li class="nav-item">
  <a class="nav-link" href="signout">
    <i class="bi bi-box-arrow-right"></i> Signout
  </a>
</li>

         
        </ul>

      
      </div>