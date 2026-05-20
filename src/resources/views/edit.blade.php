<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerts Router - Modify Node</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0f172a] text-slate-200 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-[#1e293b] rounded-2xl shadow-2xl border border-slate-800 overflow-hidden">
        <div class="bg-slate-900/60 px-6 py-5 border-b border-slate-800 flex items-center justify-between">
            <h1 class="text-lg font-bold text-white">✏️ Modify Alert Node</h1>
            <a href="{{ url('comfykure-alerts/emails') }}" class="text-xs text-slate-400 hover:text-white underline">Cancel</a>
        </div>
        <form action="{{ url('comfykure-alerts/emails/'.$email->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-xs">
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif
            <div class="mb-5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Update Email Address</label>
                <input type="email" name="email" value="{{ old('email', $email->email) }}" required class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl text-white focus:outline-none focus:border-amber-500 text-sm">
            </div>
            <button type="submit" class="w-full py-3 bg-amber-600 hover:bg-amber-500 text-white font-medium rounded-xl text-sm transition-all shadow-lg shadow-amber-600/20">Update Configuration</button>
        </form>
    </div>
</body>
</html>