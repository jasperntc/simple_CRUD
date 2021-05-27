@extends('layout')

@section('content')

<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>

<div class="card push-top">
  <div class="card-header">
    新增賬號
  </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('account_info.store') }}">
          <div class="form-group">
              @csrf
              <label for="username">賬號</label>
              <input type="text" class="form-control" name="username"/>
          </div>
          <div class="form-group">
              <label for="name">姓名</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="gender">性別</label>
              <select class="form-control" name="gender" id="gender">
                <option value="1">男</option>
                <option value="0">女</option>
              </select>
          </div>
          <div class="form-group">
              <label for="birthdate">生日</label>
              <input type="date" class="form-control" name="birthdate"/>
          </div>
        <!-- Javascript for day selection, sets max day to today -->
          <script>
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0
            var yyyy = today.getFullYear();
            if(dd<10){
                    dd='0'+dd
                }
                if(mm<10){
                    mm='0'+mm
                }
            today = yyyy+'-'+mm+'-'+dd;
            document.getElementById("birthdate").setAttribute("max", today);
          </script>

          <div class="form-group">
              <label for="email">信箱</label>
              <input type="email" class="form-control" name="email"/>
          </div>
          <div class="form-group">
              <label for="notes">備注</label>
              <input type="text" class="form-control" name="notes"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">新增賬號</button>
      </form>
  </div>
</div>
@endsection