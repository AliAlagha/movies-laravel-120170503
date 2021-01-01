<script>
@if(Session::has('Added'))

    {{--toastr.warning("{{Session::get('Added')  }}");--}}

    {{--toastr.options = {--}}
    {{--"closeButton": true,--}}
    {{--"debug": false,--}}
    {{--"newestOnTop": true,--}}
    {{--"progressBar": true,--}}
    {{--"positionClass": "toast-bottom-right",--}}
    {{--"preventDuplicates": true,--}}
    {{--"showDuration": "300",--}}
    {{--"hideDuration": "1000",--}}
    {{--"timeOut": "5000",--}}
    {{--"extendedTimeOut": "1000",--}}
    {{--"showEasing": "swing",--}}
    {{--"hideEasing": "linear",--}}
    {{--"showMethod": "fadeIn",--}}
    {{--"hideMethod": "fadeOut"--}}
    {{--};--}}
new Noty({
    text:'{{Session::get('Added')}}',
    type:'info',
    timeout:2000 ,
    theme:'mint'
}).show();

    @endif


    </script>