@extends('layouts.app')
@section('content')
    <div class="container">
        <div id="loading-image">
            <div class="justify-content-center d-flex row h-100">
                <img src="{{asset('img/loading.gif')}}">
            </div>
        </div>
        <div id="Resp" class="row">
        @include('filter')
        </div>
    </div>
    <script>
               function ajaxFilter(e) {
                    let arr = [];
                    if (['degreeSelect', 'oblSelect', 'dirSelect', 'incomeSelect'].includes(event.target.id))
                        dopFilter(e);
                    var all = $(".ajax-filter").map(function() {
                        arr[$(this).attr('name')] = $(this).val();
                    });
                    console.log('--------', arr);
                    $('#loading-image').show();
                    $.ajax({
                        type : 'get',
                        url : '{{url('/ajax-filter', [$page, $query])}}',
                        data : {'a' : JSON.stringify(Object.assign ( {}, arr ))},
                        success:function (data) {
                            // console.log('success!--',data);
                            $('#Resp').html(data);
                        },
                        complete: function() {
                            $('#loading-image').hide();
                        }
                    });
                }

               $('body').on('click', 'div.ajax-filter', function (e) {

                   console.log('LLL');
                   ajaxFilter(e);
               });
               $("body").on('change', 'select.ajax-filter', function (e) {

                   console.log('NNN');
                   ajaxFilter(e);
               });

                function dopFilter(event) {
                    console.log(event.target);
                        if (event.target.id == 'degreeSelect'){
                            if (event.target.value == '1' || event.target.value == '4'){
                                document.getElementById('sferaSelect').value = '';
                            }
                            else if(event.target.value == '2' || event.target.value == '3'){
                                document.getElementById('incomeSelect').value = '';
                                document.getElementById('1profSelect').value = '';
                                document.getElementById('2profSelect').value = '';
                            }
                        }
                        if (event.target.id == 'incomeSelect'){
                                document.getElementById('1profSelect').value = '';
                                document.getElementById('2profSelect').value = '';
                        }
                        if (event.target.id == 'oblSelect'){
                                document.getElementById('dirSelect').value = '';
                                document.getElementById('grupSelect').value = '';
                        }
                        if (event.target.id == 'dirSelect'){
                                document.getElementById('grupSelect').value = '';
                        }

                }

               jQuery(function () {
                   jQuery("#pagination-select").change(function () {
                       location.href = jQuery(this).val();
                   });
               })
    </script>
@endsection
