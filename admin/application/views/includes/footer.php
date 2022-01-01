
        <!-- Footer -->
        <footer class="footer pt-0">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="copyright text-center  text-lg-left  text-muted">
                        &copy; 2021 <a href="reta.co.id" class="font-weight-bold ml-1" target="_blank">Reta Beauty Clinic</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Argon Scripts -->
<!-- Core -->
<script src="<?= base_url() ?>assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="<?= base_url() ?>assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="<?= base_url() ?>assets/js/argon.js?v=1.2.0"></script>

<!-- Active Menu on SideNav -->
<script>
    $(function(){
    var url = window.location.pathname, 
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menuSideNav .nav-link').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });

    });
</script>

</body>
</html>