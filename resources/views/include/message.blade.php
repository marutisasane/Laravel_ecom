@if (Session('success'))

    <div class="mt-5 alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
      {{ Session('success') }}
    </div>

@endif


@if (Session('error'))

    <div class="mt-5 alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {{ Session('error') }}
    </div>

@endif


