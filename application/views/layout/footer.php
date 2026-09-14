</div> <!-- END P-3 -->
</div> <!-- END CONTENT WRAPPER -->

<!-- 1. Panggil library SweetAlert2 (Pastikan koneksi internet aktif, atau gunakan file lokal jika sudah ada) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Fungsi Konfirmasi Logout menggunakan SweetAlert2
    function konfirmasiLogout() {
        Swal.fire({
            title: 'Yakin ingin keluar aplikasi?',
            text: "Sesi Anda akan diakhiri.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oke',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('auth/logout'); ?>";
            }
        });
    }

    $(document).ready(function() {
        // Toggle Sidebar
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar, #content').toggleClass('active');
        });

        // Toggle Dropdown Menu
        $('.menu-toggle').on('click', function(e) {
            e.preventDefault();
            var $submenu = $(this).next('.treeview-menu');
            var $icon = $(this).find('.float-end');

            $('.treeview-menu').not($submenu).slideUp();
            $('.menu-toggle .float-end').not($icon).removeClass('fa-angle-down').addClass('fa-angle-left');

            $submenu.slideToggle(200);
            $icon.toggleClass('fa-angle-left fa-angle-down');
        });

        // ==========================================
        // 2. PEMANGGIL SWEETALERT TOAST OTOMATIS
        // ==========================================
        <?php if ($this->session->flashdata('toast')): ?>
            <?php $toast = $this->session->flashdata('toast'); ?>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: '<?php echo $toast['type']; ?>', // 'success', 'error', 'warning', dll
                title: '<?php echo $toast['message']; ?>',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        <?php endif; ?>

        // Jaga-jaga jika ada flashdata dengan key 'success' biasa
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '<?php echo $this->session->flashdata('success'); ?>',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        <?php endif; ?>

    });
</script>
</body>

</html>