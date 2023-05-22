

@if(count($errors) > 0)
  @foreach($errors->all() as $error)
    <script>
      toastr.options={
       "progressBar":true,
      "closeButton":true,
                    }
       toastr.error("{{ $error }}",'Erros',{timeOut:4000})

    </script>
  @endforeach
@endif

@if(Session::has('success'))
  <script>
    toastr.options={
  "progressBar":true,
 "closeButton":true,
                     }
     toastr.success("{{ Session::get('success') }}",'Sucesso',{timeOut:12000});
  </script>
@endif

@if(Session::has('error'))
  <script>
    toastr.options={
  "progressBar":true,
  "closeButton":true,
                     }
       toastr.error("{{Session::get('error')}}",'Erro',{timeOut:4000})
  </script>
@endif
