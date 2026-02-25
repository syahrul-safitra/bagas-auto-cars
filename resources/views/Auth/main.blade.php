<!DOCTYPE html>
<html lang="en" data-theme="light">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Join Our Showroom</title>
        @vite(["resources/css/app.css", "resources/js/app.js"])
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-slate-50 font-sans text-slate-900">
        <div class="flex min-h-screen items-center justify-center p-6">
            @yield("content")
        </div>
    </body>

</html>
