@if (session()->has('success'))
    <script type="text/javascript">
        $(document).ready(function() {
            notify("{{ session()->get('success') }}", 8000, "success");
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
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif