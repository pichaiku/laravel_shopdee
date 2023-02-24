<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  
  <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function() {
        $('#table').DataTable(
          {
            "oLanguage": {"sSearch": "ค้นหา:"}
          });
        
      } 
    );
</script>

</head>
<body>

@if(session()->get('success'))
  <script>    
    Swal.fire(
      'บันทึกข้อมูลเรียบร้อยแล้ว',
      '',
      'success'
    )
  </script>
@endif


      
<div class="container">
  <div class="alert alert-secondary">
    <h2>ข้อมูลลูกค้า</h2>            
  </div>
  
  <!-- @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}  
  </div><br />
  @endif -->
    
  <a href="{{ route('customer.create') }}" class="btn btn-success mb-3">เพิ่มข้อมูล</a>

    <table id="table" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>อีเมล</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
      @foreach($customers as $customer)
      <tr>
        <td>{{ $customer->firstName }}</td>
        <td>{{ $customer->lastName }}</td>
        <td>{{ $customer->email }}</td>
        <td><a href="{{ route('customer.show',$customer->custID) }}" class="btn btn-info">แสดง</a></td>
        <td><a href="{{ route('customer.edit',$customer->custID) }}" class="btn btn-warning">แก้ไข</a></td>
        <td>
          
          <form action="{{ route('customer.destroy', $customer->custID)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit" onclick="return confirm('คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่')">ลบ</button>
          </form>
          
        </td>
      </tr>
      @endforeach
      
    </tbody>  
  </table>


</body>
</html>
