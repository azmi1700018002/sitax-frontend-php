<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
            <a href="dashboard.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') {
                    echo 'active';
                } ?>"
                aria-current="true">
                <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
            </a>
            <a href="group.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == 'group.php') {
                    echo 'active';
                } ?>">
                <i class="fas fa-group fa-fw me-3"></i><span>Group</span>
            </a>
            <a href="menu.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == 'menu.php') {
                    echo 'active';
                } ?>">
                <i class="fas fa-bars fa-fw me-3"></i><span>Menu</span>
            </a>
            <a href="kewenangan.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == 'kewenangan.php') {
                    echo 'active';
                } ?>">
                <i class="fa fa-universal-access fa-fw me-3"></i><span>Kewenangan</span>
            </a>
            <a href="kantor.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == 'kantor.php') {
                    echo 'active';
                } ?>">
                <i class="fa fa-building fa-fw me-3"></i><span>Kantor</span>
            </a>
            <a href="user.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == 'user.php') {
                    echo 'active';
                } ?>">
                <i class="fas fa-user fa-fw me-3"></i><span>User</span>
            </a>
            <a href="file.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == 'file.php') {
                    echo 'active';
                } ?>">
                <i class="fa fa-file fa-fw me-3"></i><span>File</span>
            </a>
            <a href="pajak.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == 'pajak.php') {
                    echo 'active';
                } ?>">
                <i class="fa fa-file-invoice fa-fw me-3"></i><span>Pajak</span>
            </a>

            <a href="pajak-detail.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == 'pajak-detail.php') {
                    echo 'active';
                } ?>">
                <i class="fa fa-file-invoice fa-fw me-3"></i><span>Pajak-Detail</span>
            </a>

            <!-- Collapse 2 -->
            <a class="list-group-item list-group-item-action py-2 ripple" aria-current="true" data-mdb-toggle="collapse"
                href="#collapsePajak" aria-expanded="true" aria-controls="collapsePajak">
                <i class="fas fa-chart-area fa-fw me-3"></i><span>Collapse Contoh</span>
            </a>
            <!-- Collapsed content -->
            <ul id="collapsePajak" class="collapse list-group list-group-flush mx-3">
                <li class="list-group-item list-group-item-action py-2 ripple">
                    <a href="" class="text-reset"><i class="fa fa-file-invoice fa-fw me-3"></i>File Pajak</a>
                </li>
                <li class="list-group-item list-group-item-action py-2 ripple">
                    <a href="" class="text-reset"><i class="fa fa-file-invoice fa-fw me-3"></i>Pajak</a>
                </li>
                <li class="list-group-item list-group-item-action py-2 ripple">
                    <a href="" class="text-reset"><i class="fa fa-file-invoice fa-fw me-3"></i>Detail Pajak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Sidebar -->