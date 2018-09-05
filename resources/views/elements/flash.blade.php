@if (\Session::has('success'))
    <div id="alert" class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ \Session::get('success') }}
    </div>
@endif
@if (\Session::has('error'))
    <div id="alert" class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ \Session::get('error') }}
    </div>
@endif

<script type="text/javascript">
    setTimeout(function () {
        $("#alert").remove();
    }, 3000)
</script>
