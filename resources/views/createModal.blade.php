<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    
    <div class="container">
        <h1> Create new account Boostrap Popup Modal</h1>
    </div>

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  新增賬號資料
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
        <button type="submiit" class="btn btn-primary">新增賬號</button>

      </div>
    </div>
    </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>