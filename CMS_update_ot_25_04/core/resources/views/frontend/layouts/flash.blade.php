@if (session()->has('success'))
    <script type="text/javascript">
        $(document).ready(function() {
            notify("{{ session()->get('success') }}", 8000, "info");
        });
    </script>
@endif

@if (session()->has('alert'))
    <script type="text/javascript">
        $(document).ready(function() {
            notify("{{ session()->get('alert') }}", 8000, "warning");
        });
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script type="text/javascript">
            $(document).ready(function() {
                notify("{{ $error }}", 8000, "warning");
            });
        </script>
    @endforeach
@endif