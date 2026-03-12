<!-- AI Assistant Component -->
<div>
    <!-- Icon Button (top-right usage suggested) -->
    <button id="aiAssistantButton"
            class="relative inline-flex items-center justify-center rounded-xl p-3 border border-gray-200/50 bg-white/90 hover:bg-white shadow transition-all hover:shadow-lg"
            title="AI Assistant"
            onclick="openAiAssistantModal()">
        <i class="fas fa-robot text-gray-700 text-xl"></i>
        <span class="sr-only">Open AI Assistant</span>
    </button>

    <!-- Modal Backdrop -->
    <div id="aiAssistantModal" class="hidden fixed inset-0 z-[1000]">
        <div class="absolute inset-0 bg-black/50" onclick="closeAiAssistantModal()"></div>
        <div class="absolute right-6 top-20 w-[95vw] max-w-[420px] h-[70vh] bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
            <div class="flex items-center justify-between px-4 py-3 border-b">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-robot text-blue-600"></i>
                    <h3 class="font-semibold">ShopNest AI</h3>
                </div>
                <button class="p-2 rounded hover:bg-gray-100" onclick="closeAiAssistantModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Body: Either embed external widget via iframe, or show built-in chat -->
            <div class="w-full h-full">
                @php
                    $widgetUrl = config('services.ai.widget_url');
                @endphp

                @if(!empty($widgetUrl))
                    <iframe src="{{ $widgetUrl }}" title="AI Assistant" class="w-full h-full" referrerpolicy="no-referrer" allow="clipboard-write *; microphone *; camera *"></iframe>
                @else
                    <!-- Built-in lightweight AI chat (rule-based) -->
                    <div class="h-full flex flex-col p-4" id="vsn-ai" data-csrf="{{ csrf_token() }}">
                        <div id="vsn-ai-messages" class="flex-1 overflow-y-auto space-y-3 pr-1">
                            <div class="flex items-start space-x-2">
                                <div class="shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">
                                    <i class="fas fa-robot text-sm"></i>
                                </div>
                                <div class="bg-gray-100 rounded-xl px-3 py-2 text-sm max-w-[80%]">
                                    Hi! I’m ShopNest AI. Ask me about registration, login, customer/shopkeeper features, products, orders, delivery, or payments.
                                </div>
                            </div>
                        </div>
                        <form id="vsn-ai-form" class="mt-3 flex items-center space-x-2" onsubmit="return sendVsNAiMessage(event)">
                            <input id="vsn-ai-input" type="text" placeholder="Type your question..." class="flex-1 border rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-blue-700">
                                Send
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
    function openAiAssistantModal() {
        const m = document.getElementById('aiAssistantModal');
        if (m) m.classList.remove('hidden');
    }
    function closeAiAssistantModal() {
        const m = document.getElementById('aiAssistantModal');
        if (m) m.classList.add('hidden');
    }

    async function sendVsNAiMessage(e) {
        e.preventDefault();
        const input = document.getElementById('vsn-ai-input');
        const messages = document.getElementById('vsn-ai-messages');
        if (!input || !messages) return false;
        const text = (input.value || '').trim();
        if (!text) return false;

        // Append user message
        const userRow = document.createElement('div');
        userRow.className = 'flex items-start space-x-2 justify-end';
        userRow.innerHTML = `
            <div class="bg-blue-600 text-white rounded-xl px-3 py-2 text-sm max-w-[80%]">${escapeHtml(text)}</div>
            <div class="shrink-0 w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center">
                <i class="fas fa-user text-sm"></i>
            </div>
        `;
        messages.appendChild(userRow);
        messages.scrollTop = messages.scrollHeight;
        input.value = '';

        // Loading bubble
        const loading = document.createElement('div');
        loading.className = 'flex items-start space-x-2 mt-2';
        loading.innerHTML = `
            <div class="shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">
                <i class="fas fa-robot text-sm"></i>
            </div>
            <div class="bg-gray-100 rounded-xl px-3 py-2 text-sm"><span class="opacity-60">Typing…</span></div>
        `;
        messages.appendChild(loading);
        messages.scrollTop = messages.scrollHeight;

        try {
            const root = document.getElementById('vsn-ai');
            const token = root ? root.getAttribute('data-csrf') : '';
            const res = await fetch('/ai/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token || ''
                },
                body: JSON.stringify({ message: text })
            });
            const data = await res.json();
            loading.remove();

            const botRow = document.createElement('div');
            botRow.className = 'flex items-start space-x-2';
            botRow.innerHTML = `
                <div class="shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">
                    <i class="fas fa-robot text-sm"></i>
                </div>
                <div class="bg-gray-100 rounded-xl px-3 py-2 text-sm max-w-[80%]">${escapeHtml(data.reply || 'Sorry, something went wrong.')}</div>
            `;
            messages.appendChild(botRow);
            messages.scrollTop = messages.scrollHeight;
        } catch (err) {
            loading.remove();
            const botRow = document.createElement('div');
            botRow.className = 'flex items-start space-x-2';
            botRow.innerHTML = `
                <div class="shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">
                    <i class="fas fa-robot text-sm"></i>
                </div>
                <div class="bg-red-100 text-red-700 rounded-xl px-3 py-2 text-sm max-w-[80%]">Network error. Please try again.</div>
            `;
            messages.appendChild(botRow);
            messages.scrollTop = messages.scrollHeight;
        }

        return false;
    }

    function escapeHtml(text) {
        const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
        return String(text).replace(/[&<>"']/g, m => map[m]);
    }
    </script>
