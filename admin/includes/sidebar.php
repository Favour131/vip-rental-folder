
<aside class="sidebar">


        <div class="menu-toggle">

            <i class="fa-solid fa-bars"></i>

</div> 
 

    <!-- Logo -->

    <div class="logo">

        <h2>VIP Rental</h2>

        <p>Admin Panel</p>

    </div>

    <div class="sidebar-scroll-rail" tabindex="0" role="region" aria-label="Admin sidebar navigation">

        <ul class="sidebar-menu">

        <li class="<?= ($currentPage == 'dashboard') ? 'active' : ''; ?>">

            <a href="dashboard.php">

                <i class="fa-solid fa-house"></i>

                Dashboard

            </a>

        </li>

        <li class="<?= ($currentPage == 'manage-users') ? 'active' : ''; ?>">

            <a href="manage-users.php">

                <i class="fa-solid fa-users"></i>

                Manage Users

            </a>

        </li>
        

        <li class="<?= ($currentPage == 'manage-bookings') ? 'active' : ''; ?>">

            <a href="manage-bookings.php">

                <i class="fa-solid fa-calendar-check"></i>

                Bookings

            </a>

        </li>

        <li class="<?= ($currentPage == 'manage-vehicles') ? 'active' : ''; ?>">

            <a href="manage-vehicles.php">

                <i class="fa-solid fa-car"></i>

                Vehicles

            </a>

        </li>
        <li class="<?= ($currentPage == 'manage-reviews') ? 'active' : ''; ?>">

            <a href="manage-reviews.php">

                <i class="fa-solid fa-star"></i>

                Reviews

            </a>

        </li>

        <!-- <li class="<?= ($currentPage == 'manage-drivers') ? 'active' : ''; ?>">

            <a href="manage-drivers.php">

                <i class="fa-solid fa-id-card"></i>

                Drivers

            </a>

        </li> -->

        <!-- <li class="<?= ($currentPage == 'payments') ? 'active' : ''; ?>">

            <a href="payments.php">

                <i class="fa-solid fa-credit-card"></i>

                Payments

            </a>

        </li> -->
        
        
        <li class="<?= ($currentPage == 'profile') ? 'active' : ''; ?>">

            <a href="profile.php">

                <i class="fa-solid fa-user"></i>

                Profile

            </a>

        </li>

        <li>

            <a href="logout.php">

                <i class="fa-solid fa-right-from-bracket"></i>

                Logout

            </a>

        </li>

        </ul>

    </div>

</aside>