@extends('layouts/contentNavbarLayout')

<link rel="stylesheet" href="{{ asset('assets/datatables4/css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/datatables4/css/dataTables.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.css') }}" />

@section('content')
<div class="col-md-12">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Employee / </span> List
    <a href="{{ route('employee-create') }}" class="btn btn-primary text-white float-right">Create</a>
  </h4>
</div>
<!-- Hoverable Table rows -->
<div class="card">
  <!-- <h5 class="card-header">Hoverable rows</h5> -->
  <div class="card-body table-responsive">
    <table id="example" class="table table-hover table-striped table-bordered">
      <thead>
        <tr>
          <th>Sl</th>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <!-- <th>Address</th> -->
          <th>Position</th>
          <th>Department</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        
        <?php foreach ($employee as $key => $value): ?>
          <tr>
        		<td>{{ ++$key }}</td>
        		<td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $value->name }}</strong></td>
            <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->email }}</strong></td>
            <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->mobile }}</strong></td>
            <!-- <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->address }}</strong></td> -->
            <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->position }}</strong></td>
            <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->dept }}</strong></td>
            <td>
        		  <div class="dropdown">
        		    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
        		    <div class="dropdown-menu">
        		      <a class="dropdown-item" href="{{ route('employee-edit',$value->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
        		      <form action="{{ route('employee-destroy', $value->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn bx bx-trash me-1" type="submit">Delete</button>
                  </form>
        		    </div>
        		  </div>
        		</td>
          </tr>  
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
@endsection

<script src="{{ asset('assets/datatables4/js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('assets/datatables4/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('assets/datatables4/js/dataTables.bootstrap.min.js') }}" defer></script>
<script src="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('assets/jquery-toast-plugin/toastDemo.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#example').DataTable();
  });
</script>
<script type="text/javascript">
  $(document).ready(function () {
    @if (session('success'))
    showSuccessToast('{{ session("success") }}');
    @elseif(session('warning'))
    showWarningToast('{{ session("warning") }}');
    @elseif(session('danger'))
    showDangerToast('{{ session("danger") }}');
    @endif
  });
</script>