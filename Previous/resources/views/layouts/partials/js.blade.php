<script src="{{asset('base/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('base/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('base/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('base/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('base/assets/js/app.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js" integrity="sha512-M+hXwltZ3+0nFQJiVke7pqXY7VdtWW2jVG31zrml+eteTP7im25FdwtLhIBTWkaHRQyPrhO2uy8glLMHZzhFog==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('base/assets/js/custom.js')}}"></script>
<script src="{{asset('base/plugins/highlight/highlight.pack.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->







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
    $(function() {    // Makes sure the code contained doesn't run until
        //     all the DOM elements have loaded

        $('#cDriver_id').change(function(){

            $('.collect_case').hide();
            $('#' + $(this).val()).show();
        });

    });
    $(function() {    // Makes sure the code contained doesn't run until
        //     all the DOM elements have loaded

        $('#case_id').change(function(){

            $('.case_payment').hide();
            $('#' + $(this).val()).show();
        });

    });
</script>

