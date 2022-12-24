@extends('layouts/contentNavbarLayout')

<!-- @section('title', 'Tables - Basic Tables') -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account / Ledger Type / </span> Tables
  <a href="{{ route('ledger-ledgerType-create') }}" class="btn btn-primary text-white" style="margin-left: 90%">Create</a>
</h4>

<!-- Hoverable Table rows -->
<div class="card">
  <!-- <h5 class="card-header">Hoverable rows</h5> -->
  <div class="table text-nowrap">
    <table id="example" class="table table-hover table-striped table-bordered">
      <thead>
        <tr>
          <th>Sl</th>
          <th>Type Name</th>
          <th>Code</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        
        <?php foreach ($ledgerType as $key => $value): ?>
          <tr>  
        		<td>{{ ++$key }}</td>
        		<td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $value->type_name }}</strong></td>
            <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $value->code }}</strong></td>
        		<td>
        		  <div class="dropdown">
        		    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
        		    <div class="dropdown-menu">
        		      <a class="dropdown-item" href="{{ route('ledger-ledgerType-edit',$value->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
        		      <form action="{{ route('ledger-ledgerType-destroy', $value->id)}}" method="post">
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

 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" defer></script>
 <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function () {
       $('#example').DataTable();
   });
 </script>