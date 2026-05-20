<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ComfyKure Alerts Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0f172a] text-slate-200 min-h-screen flex items-center justify-center p-4 sm:p-6">

    <div class="w-full max-w-3xl bg-[#1e293b] rounded-2xl shadow-2xl border border-slate-800 overflow-hidden">

        <div class="bg-gradient-to-r from-red-500/20 to-amber-500/10 px-6 py-5 border-b border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-red-500/10 rounded-lg text-red-400 animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white tracking-wide">ComfyKure Alerts Engine</h1>
                    <p class="text-xs text-slate-400 mt-0.5">Dynamic Crash Notification Recipients</p>
                </div>
            </div>
            <span class="px-2.5 py-1 text-xs font-semibold bg-emerald-500/10 text-emerald-400 rounded-full border border-emerald-500/20">v1.0.0</span>
        </div>

        <div class="p-6 sm:p-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('comfykure-alerts/emails') }}" method="POST" class="flex flex-col sm:flex-row gap-3 mb-8">
                @csrf
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <input type="email" name="email" required
                        class="w-full pl-11 pr-4 py-3 bg-[#0f172a] border border-slate-700/80 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all text-sm"
                        placeholder="developer@comfykure.live">
                </div>
                <button type="submit"
                    class="px-6 py-3 bg-red-600 hover:bg-red-500 text-white font-medium rounded-xl text-sm transition-all duration-200 shadow-lg shadow-red-600/20 active:scale-[0.98] shrink-0">
                    Add Node
                </button>
            </form>

            <div class="border-t border-slate-800/60 pt-6">
                <h2 class="text-sm font-semibold text-slate-400 tracking-wider uppercase mb-4">Active Routing Broadcast List</h2>

                <div class="bg-[#0f172a] rounded-xl border border-slate-800/80 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-800/80 bg-slate-900/40 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                                <th class="px-6 py-3.5">Developer Email</th>
                                <th class="px-6 py-3.5">Status</th>
                                <th class="px-6 py-3.5 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 text-sm">
                            @forelse($emails as $email)
                                <tr class="hover:bg-slate-900/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-white">{{ $email->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/10">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                            Listening
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ url('comfykure-alerts/emails/'.$email->id) }}" method="POST" onsubmit="return confirm('Remove this developer from system alerts?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-500 hover:text-red-400 font-medium text-xs transition-colors py-1 px-2 hover:bg-red-500/10 rounded-md">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-10 text-center text-slate-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-slate-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                        No active developers registered. All system crashes will be muted.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
