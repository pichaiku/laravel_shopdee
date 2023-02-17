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

    <h2>รายละเอียดลูกค้า</h2>
    <div class="card">
      <div class="card-body">
      
        <div class="mb-3">
          <label for="username" class="form-label">ชื่อผู้ใช้:</label>
          {{$customer->username}}
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">รหัสผ่าน:</label>
          {{$customer->password}}
        </div>

        <div class="mb-3 mt-3">
          <label for="firstName" class="form-label">ชื่อ:</label>
          {{$customer->firstName}}
        </div>

        <div class="mb-3">
          <label for="lastName" class="form-label">นามสกุล:</label>
          {{$customer->lastName}}
        </div>

      </form>

    </div>
  </div>
</body>
</html>