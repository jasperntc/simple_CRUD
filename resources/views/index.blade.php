@extends('layout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>

<!-- Button trigger for storeModal -->
<button type="button" class="btn btn-primary push-top" data-bs-toggle="modal" data-bs-target="#storeModal">
  新增賬號資料
</button>

<!-- Store Modal -->
<div class="modal fade" id="storeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">新增賬號資料</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Start modal -->
        <form method="post" action="{{ route('account_info.store') }}">

        {{ csrf_field() }}
        <div class="modal-body">

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
              <label>性別</label><br>
              <input type="radio" name="gender" id="male" value="1"/>
              <label for="male">男</label>
              <input type="radio" name="gender" id="female" value="0"/>
              <label for="female">女</label>
          </div>

          <div class="form-group">
              <label for="birthdate">生日</label>
              <input type="date" class="form-control" name="birthdate" id="birthdate"/>
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

          <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
        <button type="submiit" class="btn btn-primary" onclick="return confirm('確定要新增此賬號資料嗎？');">新增賬號</button>

      </div>
    </div>
    </form>
    </div>
  </div>
</div>
<!-- End of Store Modal -->

<div class="push-top">
  @if(session()->get('completed'))
    <div class="alert alert-success">
      {{ session()->get('completed') }}  
    </div><br />
  @endif
  @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
  <table class="table" id="account_info_table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Username</td>
          <td>Name</td>
          <td>Gender</td>
          <td>Birthdate</td>
          <td>Email</td>
          <td>Notes</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @if($account_info->count()==0)
        <tr>
        <td colspan="5">沒有找到任何相關賬號資料</td>
        </tr>
        @endif
        @foreach($account_info as $account_infos)
        <tr>
            <td>{{$account_infos->id}}</td>
            <td>{{$account_infos->username}}</td>
            <td>{{$account_infos->name}}</td>
            <!-- Gender translation from boolean, 1 = Male, 0 = Female -->
            <td><?php 
            if($account_infos->gender==1){
                echo '男';    
            }
            elseif($account_infos->gender==0){
                echo '女';
            }
            ?></td>
            <!-- Date convert from yyyy-mm-dd to yyyy年 m月 d日 -->
            <td><?php echo date('Y 年 n 月 j 日', strtotime($account_infos->birthdate)); ?></td>
            <td>{{$account_infos->email}}</td>
            <td>{{$account_infos->notes}}</td>
            <td class="text-center">
                <!-- Button trigger for editModal -->
                <!-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-id="{{$account_infos->id}}">編輯</button> -->
                <a href="{{ route('account_info.edit', $account_infos->id)}}" class="btn btn-primary btn-sm">編輯</a>
                <form action="{{ route('account_info.destroy', $account_infos->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('確定要刪除此賬號資料嗎？');">刪除</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
<!-- Script -->
  <script type="text/javascript">
    $(document).ready(function(){

      // DataTable
      $('#account_info_table').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('account_info.getAccountInfos')}}",
         columns: [
            { data: 'id' },
            { data: 'username' },
            { data: 'name' },
            { data: 'gender' },
            { data: 'birthdate' },
            { data: 'email' },
            { data: 'notes' },
         ]
      });

    });
    </script>
@endsection