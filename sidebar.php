<nav id="sidebarMenu" class="collapse d-lg-block sidebar col bg-white" style="max-width: 300px;">
    <div class="position-sticky">
        <div class="list-group">
            <div class="list-group-item list-group-item-action ripple">
                <i class="fa-solid fa-bars me-3 text-primary"></i><span>Menu Profil</span>
            </div>
            <a href="index.php?user=<?php echo escape($user->data()->username); ?>" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fa-solid fa-circle-info me-3 text-primary"></i><span>Lihat Profil</span>
            </a>
            <a href="index.php?update" class="list-group-item list-group-item-action ripple">
                <i class="fa-solid fa-pencil me-3 text-primary"></i><span>Perbarui Profil</span>
            </a>
            <a href="index.php?changepassword" class="list-group-item list-group-item-action ripple">
                <i class="fa-solid fa-key me-3 text-primary"></i><span>Ganti Kata Sandi</span>
            </a>
        </div>
    </div>
</nav>