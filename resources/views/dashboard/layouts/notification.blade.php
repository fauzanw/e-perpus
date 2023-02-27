@if(session()->has('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#4fbe87",
        }).showToast();
    </script>
@endif

@if(session()->has('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#dc3545"
        }).showToast();
    </script>
@endif