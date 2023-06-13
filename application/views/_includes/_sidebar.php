<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item <?= ($this->uri->segment(1) == "produk") || empty($this->uri->segment(1)) ? "selected" : "" ?>"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url("") ?>" aria-expanded="false">
                        <i class="mdi mdi-chart-bar"></i>
                        <span class="hide-menu">Produk</span>
                    </a>
                </li>
                <li class="sidebar-item <?= $this->uri->segment(1) == "api" ? "selected" : "" ?>"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url("api") ?>" aria-expanded="false">
                        <i class="mdi mdi-chart-bubble"></i>
                        <span class="hide-menu">API</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>