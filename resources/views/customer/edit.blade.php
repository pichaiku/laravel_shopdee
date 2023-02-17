<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  
  <div class="container mt-3" style="max-width: 600px;">

    @if($errors->any())
    <div class="alert alert-danger mb-3">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <h2>สมัครสมาชิก</h2>
    <div class="card">
      <form method="post" class="card-body" action="{{ route('customer.store') }}">
      @csrf
        <div class="mb-3">
          <label for="username" class="form-label">ชื่อผู้ใช้:</label>
          <input type="text" class="form-control" id="username"  name="username" value="{{$customer->username}}" placeholder="กรุณาระบุชื่อผู้ใช้" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">รหัสผ่าน:</label>
          <input type="password" class="form-control" id="password" name="password" value="{{$customer->password}}" placeholder="กรุณาระบุรหัสผ่าน" required>
        </div>

        <div class="mb-3 mt-3">
          <label for="firstName" class="form-label">ชื่อ:</label>
          <input type="text" class="form-control" id="firstName"  name="firstName" value="{{$customer->firstName}}" placeholder="กรุณาระบุชื่อ" required>
        </div>

        <div class="mb-3">
          <label for="lastName" class="form-label">นามสกุล:</label>
          <input type="text" class="form-control" id="lastName" name="lastName" value="{{$customer->lastName}}" placeholder="กรุณาระบุนามสกุล" required>
        </div>

        <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>

      </form>

    </div>
  </div>
</body>
</html>