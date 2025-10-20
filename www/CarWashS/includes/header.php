<!-- Header include for CarWashS - include this file from pages in the CarWashS folder:
  <?php include __DIR__ . '/header.php'; ?> -->
<nav class="site-header" id="siteHeader">
  <div class="nav-inner">
    <div class="nav-left" style="display:flex;align-items:center;gap:12px">
      <button class="nav-toggle" id="navToggle" aria-expanded="false" aria-controls="mainNav">
        <span class="hamburger" aria-hidden="true"></span>
        <span class="sr-only">Toggle navigation</span>
      </button>

      <a href="/" class="site-title nav-brand" aria-label="Home">
        <span class="brand">The Crew Car Wash</span>
      </a>
    </div>

    <div class="main-nav" id="mainNav" role="navigation" aria-label="Primary">
      <ul>
        <li><a href="client.php" class="active">Dashboard</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="bookings.php">Bookings</a></li>
        <li><a href="reports.php">Reports</a></li>
      </ul>
    </div>

    <div class="nav-right" style="display:flex;align-items:center;gap:12px">
      <div class="nav-search" role="search">
        <input type="search" placeholder="Search bookings..." aria-label="Search bookings" />
      </div>

      <div class="user-block" style="position:relative">
        <button id="userBtn" class="user-toggle" aria-haspopup="true" aria-expanded="false" aria-controls="userMenu">
          <img src="images/avatar.png" alt="User avatar" class="user-avatar" />
        </button>
        <div id="userMenu" class="user-menu" role="menu" hidden>
          <a href="profile.php" role="menuitem">Profile</a>
          <a href="settings.php" role="menuitem">Settings</a>
          <a href="logout.php" role="menuitem">Sign out</a>
        </div>
      </div>
    </div>
  </div>
</nav>

<script src="includes/nav.js" defer></script>
