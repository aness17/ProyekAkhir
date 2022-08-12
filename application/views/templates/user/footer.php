 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">
     <div class="footer-legal text-center">
         <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

             <div class="d-flex flex-column align-items-center align-items-lg-start">
                 <div class="copyright">
                     &copy; Copyright <strong><span>HeroBiz</span></strong>. All Rights Reserved
                 </div>
                 <div class="credits">
                     <!-- All the links in the footer should remain intact. -->
                     <!-- You can delete the links only if you purchased the pro version. -->
                     <!-- Licensing information: https://bootstrapmade.com/license/ -->
                     <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
                     Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                 </div>
             </div>

             <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                 <a href="https://twitter.com/vieraoleholeh" class="twitter"><i class="bi bi-twitter"></i></a>
                 <a href="https://www.facebook.com/pusatoleholehterbesardipekanbaru/" class="facebook"><i class="bi bi-facebook"></i></a>
                 <a href="https://www.instagram.com/vieraoleholeh.id/" class="instagram"><i class="bi bi-instagram"></i></a>
                 <a href="https://www.tiktok.com/@vieraentertainment" class="google-plus"><i class="bi bi-tiktok"></i></a>
                 <a href="https://linktr.ee/Vieraoleholeh" class="linkedin"><i class="bi bi-whatsapp"></i></a>
             </div>

         </div>
     </div>

 </footer><!-- End Footer -->

 <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <div id="preloader"></div>

 <!-- Vendor JS Files -->
 <script src="<?= base_url('assets/') ?>pelanggan/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="<?= base_url('assets/') ?>pelanggan/assets/vendor/aos/aos.js"></script>
 <script src="<?= base_url('assets/') ?>pelanggan/assets/vendor/glightbox/js/glightbox.min.js"></script>
 <script src="<?= base_url('assets/') ?>pelanggan/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
 <script src="<?= base_url('assets/') ?>pelanggan/assets/vendor/swiper/swiper-bundle.min.js"></script>
 <script src="<?= base_url('assets/') ?>pelanggan/assets/vendor/php-email-form/validate.js"></script>

 <script src="<?= base_url('assets/') ?>admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
 <script src="<?= base_url('assets/') ?>admin/assets/vendor/datatables/jquery.dataTables.min.js"></script>

 <!-- Template Main JS File -->
 <script src="<?= base_url('assets/') ?>pelanggan/assets/js/main.js"></script>
 <script>
     $(document).ready(function() {
         $('.produkSelect').select2().on('change', (e) => {
             console.log(`<?= base_url("auth/deskripsi_produk") ?>/${e.target.value}?search=true`)
             window.location.href = `<?= base_url("auth/deskripsi_produk") ?>/${e.target.value}?search=true`
         });
     })
 </script>
 </body>

 </html>