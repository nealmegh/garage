

<!-- Jquery JS-->
{{--    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>--}}
<script src="/vendor/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Bootstrap JS-->
<script src="/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="/vendor/slick/slick.min.js">
</script>
<script src="/vendor/wow/wow.min.js"></script>
<script src="/vendor/animsition/animsition.min.js"></script>
<script src="/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="/vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="/vendor/circle-progress/circle-progress.min.js"></script>
<script src="/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="/vendor/select2/select2.min.js">
</script>


<!-- Main JS-->
<script src="/js/main.js"></script>

{{--datepicker--}}
{{--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {    // Makes sure the code contained doesn't run until
        //     all the DOM elements have loaded

        $('#driver_id').change(function(){

            $('.damage').hide();
            $('#' + $(this).val()).show();
        });

    });
    $(function() {    // Makes sure the code contained doesn't run until
        //     all the DOM elements have loaded

        $('#customer_id').change(function(){

            $('.cus_collection').hide();
            $('#' + $(this).val()).show();
        });

    });
    $(function() {    // Makes sure the code contained doesn't run until
        //     all the DOM elements have loaded

        $('#supplier_id').change(function(){

            $('.sup_payment').hide();
            $('#' + $(this).val()).show();
        });

    });
</script>

