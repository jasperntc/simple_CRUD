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
    編輯賬號資料
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
      <form method="post" action="{{ route('account_info.update', $account_info->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="username">賬號</label>
              <input type="text" class="form-control" name="username" value="{{ $account_info->username }}"/>
          </div>
          <div class="form-group">
              <label for="name">姓名</label>
              <input type="text" class="form-control" name="name" value="{{ $account_info->name }}"/>
          </div>
          <div class="form-group">
              <label>性別</label><br>
              <input type="radio" name="gender" id="male" value="1" <?php if($account_info->gender==1){echo 'checked';} ?>/>
              <label for="male">男</label>
              <input type="radio" name="gender" id="female" value="0" <?php if($account_info->gender==0){echo 'checked';} ?>/>
              <label for="female">女</label>
          </div>
          <div class="form-group">
              <label for="birthdate">生日</label>
              <input type="date" class="form-control" name="birthdate" id="birthdate" value="{{ $account_info->birthdate }}"/>
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
              <input type="email" class="form-control" name="email" value="{{ $account_info->email }}"/>
          </div>
          <div class="form-group">
              <label for="notes">備注</label>
              <input type="text" class="form-control" name="notes" value="{{ $account_info->notes }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">更新賬號資料</button>
      </form>
  </div>
</div>
@endsection