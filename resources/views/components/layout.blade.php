<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Employee Hiring</title>

</head>

<body>

    @if (session('success'))
        <div
            class="fixed top-4 right-4 z-50 flex max-w-sm rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 shadow-lg alert">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <span
            class="fixed top-4 right-4 z-50 flex max-w-sm rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-red-500 shadow-lg alert">
            {{ session('error') }}
        </span>
    @endif


    {{ $slot }}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <script>
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.display = 'none';
            });
        }, 3000);
    </script>
</body>

</html>
