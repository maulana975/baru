<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoldTicket - Travel Booking</title>
</head>
<body>
    <script>
        // Redirect to dashboard
        window.location.href = '{{ route("dashboard") }}';
    </script>
    <p>Redirecting to dashboard...</p>
</body>
</html>
