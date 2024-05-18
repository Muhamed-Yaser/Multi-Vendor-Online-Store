@if (session()->has($type))
    <div id="successMessage" class="alert alert-{{ $type }}" style="width:30% ; text-align: center">
        {{ session($type) }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 5000);
    </script>
@endif
