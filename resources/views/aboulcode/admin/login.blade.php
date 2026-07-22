<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ABOULCODE Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>body{background:#f8fafc}</style>
</head>
<body class="flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-semibold mb-6">ABOULCODE — Admin</h1>
        <form method="POST" action="{{ url('/abouadmin/login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input name="email" type="email" required class="mt-1 block w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input name="password" type="password" required class="mt-1 block w-full border rounded px-3 py-2">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Sign in</button>
            </div>
        </form>
    </div>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>ABOULCODE Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>body{background:#f8fafc}</style>
</head>
<body class="flex items-center justify-center h-screen">
  <div class="max-w-md w-full bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-semibold mb-6 text-center">ABOULCODE Admin</h1>
    <form method="POST" action="/abouadmin/login">
      @csrf
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Email</label>
        <input name="email" type="email" required class="w-full border rounded p-2" />
      </div>
      <div class="mb-6">
        <label class="block text-sm font-medium mb-1">Password</label>
        <input name="password" type="password" required class="w-full border rounded p-2" />
      </div>
      <div class="text-center">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded">Sign in</button>
      </div>
    </form>
  </div>
</body>
</html>
