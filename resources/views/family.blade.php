@extends('pages.layouts.app')

@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="card uper mb-3 ml-3 mr-3">
    <div class="card-header">
    ระบบผู้เชื่ยวชาญ
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
        <form method="post" action="{{ route('family.compute') }}">
        @csrf
            <div class="row">
                <div class=" col-md-8 mb-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">คำถาม:</label>
                            <input type="text" class="form-control" name="firstName" maxlength="100" required/>
                        </div>
                        <div class="col-md-6 mb-3">
                            
                        </div>
                    </div> 

            </div>

            <button type="submit" class="btn btn-primary mb-3" style="width:100px">บันทึก</button>
            <button type="reset" class="btn btn-danger mb-3" style="width:100px">ยกเลิก</button>
        </form>
    </div>
</div></br>
<script type="text/javascript">
  $('#provinceID').on('change', function() {
      var url = '/employee/district/' + $('#provinceID').val();
      $('#districtID').empty();
      $('#subdistrictID').empty();
      $('#districtID').html('<option selected="selected" value="">Loading...</option>');

      $.ajax({
          url: url,
          type: "GET",
          dataType: "json",
          success:function(data) {
              //console.log(data);
              $('#districtID').html('<option selected="selected" value=""></option>');
              $.each(data, function(key, value) {
                  $('#districtID').append('<option value="'+key+'">'+value+'</option>');
              });

          }
      });
  });

  $('#districtID').on('change', function() {
      var url = '/employee/subdistrict/' + $('#districtID').val();
      $('#subdistrictID').empty();
      $('#subdistrictID').html('<option selected="selected" value="">Loading...</option>');

      $.ajax({
          url: url,
          type: "GET",
          dataType: "json",
          success:function(data) {
              //console.log(data);
              $('#subdistrictID').html('<option selected="selected" value=""></option>');
              $.each(data, function(key, value) {
                  $('#subdistrictID').append('<option value="'+key+'">'+value+'</option>');
              });

          }
      });
  });
</script>
@endsection