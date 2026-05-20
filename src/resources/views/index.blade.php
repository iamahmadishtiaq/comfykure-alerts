<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerts Router - Listing</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0f172a] text-slate-200 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-3xl bg-[#1e293b] rounded-2xl shadow-2xl border border-slate-800 overflow-hidden">
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-6 py-5 border-b border-slate-800 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-white tracking-wide">🚨 ComfyKure Broadcast Nodes</h1>
                <p class="text-xs text-slate-400 mt-0.5">Active monitoring recipient terminal</p>
            </div>
            <a href="{{ url('comfykure-alerts/emails/create') }}" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white font-medium rounded-xl text-xs transition-all shadow-lg shadow-red-600/20">
                + Register New Node
            </a>
        </div>
        <div class="p-6">
            @if(session('success'))
                <div class="mb-4 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm">{{ session('success') }}</div>
            @endif
            <div class="bg-[#0f172a] rounded-xl border border-slate-800/80 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-800/80 bg-slate-900/40 text-slate-400 text-xs font-semibold uppercase tracking-wider"><th class="px-6 py-3.5">Developer Email</th><th class="px-6 py-3.5">Status</th><th class="px-6 py-3.5 text-right">Actions</th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-sm">
                        @forelse($emails as $email)
                            <tr class="hover:bg-slate-900/30 transition-colors">
                                <td class="px-6 py-4 font-medium text-white">{{ $email->email }}</td>
                                <td class="px-6 py-4"><span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/10"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>Listening</span></td>
                                <td class="px-6 py-4 text-right flex items-center justify-end gap-3">
                                    <a href="{{ url('comfykure-alerts/emails/'.$email->id.'/edit') }}" class="text-amber-400 hover:underline text-xs">Edit</a>
                                    <form action="{{ url('comfykure-alerts/emails/'.$email->id) }}" method="POST" onsubmit="return confirm('Remove this node?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-slate-500 hover:text-red-400 text-xs">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-6 py-10 text-center text-slate-500 text-sm">No active developers registered. System crashes are muted.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>