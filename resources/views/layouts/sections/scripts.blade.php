<!-- BEGIN: Vendor JS-->

<script src="{{asset("assets/js/jquery.min.js")}}"></script>
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
<script src="{{asset("assets/js/persian-date.min.js")}}"></script>
<script src="{{asset("assets/js/persian-datepicker.min.js")}}"></script>
<script src="{{asset("assets/js/app.js")}}"></script>

<script>
    $("#searchSec").bind("keypress", {}, keypressInBox);

    function keypressInBox(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) { //Enter keycode
            e.preventDefault();

            $("#searchFormSec").submit();
        }
    };

    // function citiesFunc(id){
    //     var url=$(location).attr("origin");
    //     $.ajax({
    //         type: 'GET',
    //         url: url+'/cities/by/province/'+id,
    //         dataType: 'json',
    //         success: function(data)
    //         {
    //             console.log(data);
    //             $("#citySec").empty();
    //             $.each(data, function( item, value ) {
    //                 $("#citySec").append("<option value='"+value.id+"'>"+value.name+"</option>") ;
    //             });
    //         }
    //     });
    // }

    $('#provinceSec').change(function () {
        var url=$(location).attr("origin");
        var id = $(this).find(':selected')[0].id;
        // alert(id);
        $.ajax({
            type: 'GET',
            url: url+'/cities/by/province/'+id,
            success: function (data) {
                console.log(data);
                $('#citySec').empty();
                for (var i = 0; i < data.length; i++) {
                    $("#citySec").append('<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].name + '</option>');
                }

            }
        });

    });


    $("#permissions").select2({
        placeholder: "choose ...",
        allowClear: true
    });

</script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
