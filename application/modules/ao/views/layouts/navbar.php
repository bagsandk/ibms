<div class="topbar-nav header navbar" role="banner">
  <nav id="topbar">
    <ul class="navbar-nav theme-brand flex-row  text-center">
      <li class="nav-item theme-logo">
        <a href="index.html">
          <img src="<?= base_url() ?>assets/light/main/img/90x90.jpg" class="navbar-logo" alt="logo">
        </a>
      </li>
      <li class="nav-item theme-text">
        <a href="index.html" class="nav-link">AO</a>
      </li>
    </ul>

    <ul class="list-unstyled menu-categories" id="topAccordion">

      <?php foreach (menuAccess() as $m) : ?>
        <li class="menu single-menu <?= menuActive($m->url)?>">
          <a href="<?= base_url($m->url) ?>" aria-expanded="true" class="dropdown-toggle">
            <div class="">
              <?= $m->icon ?>
              <span><?= $m->name ?></span>
            </div>
          </a>
        </li>
      <?php endforeach ?>
    </ul>
  </nav>
</div>