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
        $('.chsn').chosen();
        $('body').on('change', '.ajax-filter', function () {
            let arr = [];
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
                complete: function(){
                    $('#loading-image').hide();
                }
            });
        })
    </script>
@endsection
