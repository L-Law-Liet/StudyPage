@section('errors')
    @if (is_object($errors) && $errors->any())
        <div class="container">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @endsection
<div class="row">
    <div class="col-md-10 offset-md-1 m-t-10">
        <form action={{ URL::action("IndexController@postProposal") }} method="POST">
            @csrf
            <div class="form-group row">
                <label class="col-md-4">Имя контактного лица*</label>
                <div class="col-md-8">
                    <input type="text" name="contact_name" class="form-control" value="{{ old('contact_name')}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4">Название учебного заведения*</label>
                <div class="col-md-8">
                    <input type="text" name="university_name" class="form-control" value="{{ old('university_name')}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4">Контактный телефон*</label>
                <div class="col-md-8">
                    <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone')}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4">Электронная почта*</label>
                <div class="col-md-8">
                    <input type="email" name="email" class="form-control" value="{{ old('email')}}">
                </div>
            </div>
            <div class="clearfix">
                <div class="form-group">
                    <button class="btn col-4 text-capitalize btn-primary-custom float-right">
                        Отправить
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
