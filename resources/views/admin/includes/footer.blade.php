<!--Footer Start-->
<footer class="container-fluid">
    <div class="row footer">
        <div class="col-12">
            @if(isset($footer))
            <p class="pt-2 mb-2 text-center">Copyright &copy; <a class="footer-link" href="">{{ $footer->copyright }}</a> || Developed  by:
                <a class="footer-link" href="http://www.fzitsolution.net">FZIT Solution</a></p>
            @else
            <p class="pt-2 mb-2 text-center">Copyright &copy; <a class="footer-link" href="">Owner</a> || Developed  by:
                <a class="footer-link" href="http://www.fzitsolution.net">FZIT Solution</a></p>
            @endif
        </div>
    </div>
</footer>
<!--Footer End-->

    <!--    jQuery-->
    <script src="{{asset('/')}}/admin/assets/js/jquery-3.5.1.js"></script>
    <!--    magnific popup-->
    <script src="{{asset('/')}}/admin/assets/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
    <!--    Carousel-->
    <script src="{{asset('/')}}/admin/assets/plugins/owl-carosel/js/owl.carousel.min.js"></script>
    <!--    Bootstrap-4.3-->
    <script src="{{asset('/')}}/admin/assets/js/popper.min.js"></script>
    <script src="{{asset('/')}}/admin/assets/js/bootstrap.min.js"></script>
    <script src="{{asset('/')}}/admin/assets/js/sub-dropdown.js"></script>
    <!--Data table-->
    <script src="{{asset('/')}}/admin/assets/plugins/data-table/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('/')}}/admin/assets/plugins/data-table/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('/')}}/admin/assets/plugins/data-table/js/dataTables.fixedHeader.min.js"></script>
    <!--    Theme Script-->
    <script src="{{asset('/')}}/admin/assets/js/script.js"></script>
     @stack('js')
</body>
</html>