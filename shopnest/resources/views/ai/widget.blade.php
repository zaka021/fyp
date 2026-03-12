<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ShopNest AI Widget</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin:0; }
        .wrap { display:flex; flex-direction:column; height:100vh; }
        .head { display:flex; align-items:center; justify-content:space-between; padding:10px 12px; border-bottom:1px solid #eee; }
        .head .title { display:flex; align-items:center; gap:8px; font-weight:600; color:#0f172a; }
        .messages { flex:1; overflow:auto; padding:12px; background:#fff; }
        .row { display:flex; gap:8px; margin-bottom:10px; }
        .row.bot .bubble { background:#f3f4f6; color:#111827; }
        .row.user { justify-content:flex-end; }
        .row.user .bubble { background:#2563eb; color:white; }
        .bubble { padding:10px 12px; border-radius:12px; max-width:75%; font-size:14px; }
        .input { display:flex; gap:8px; padding:10px; border-top:1px solid #eee; }
        input[type=text]{ flex:1; padding:10px 12px; border:1px solid #e5e7eb; border-radius:10px; font-size:14px; outline:none; }
        button { background:#2563eb; color:white; border:none; border-radius:10px; padding:10px 14px; cursor:pointer; }
        button:hover { background:#1d4ed8; }
        .avatar { width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center; }
        .avatar.bot { background:#2563eb; color:white; }
        .avatar.user { background:#e5e7eb; color:#374151; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="head">
        <div class="title"><span class="avatar bot"><i class="fas fa-robot"></i></span> ShopNest AI</div>
    </div>
    <div id="msgs" class="messages">
        <div class="row bot"><div class="avatar bot"><i class="fas fa-robot"></i></div><div class="bubble">Hi! Ask me about registration, login, customer/shopkeeper features, products, orders, delivery, or payments.</div></div>
    </div>
    <form class="input" onsubmit="return sendMsg(event)">
        <input id="inp" type="text" placeholder="Type your question..." />
        <button type="submit">Send</button>
    </form>
</div>
<script>
function esc(t){return String(t).replace(/[&<>"']/g, m=>({"&":"&amp;","<":"&lt;",">":"&gt;","\"":"&quot;","'":"&#039;"}[m]))}
async function sendMsg(e){
  e.preventDefault();
  const inp=document.getElementById('inp');
  const msgs=document.getElementById('msgs');
  const text=(inp.value||'').trim(); if(!text) return false;
  msgs.insertAdjacentHTML('beforeend', `<div class='row user'><div class='bubble'>${esc(text)}</div><div class='avatar user'><i class='fas fa-user'></i></div></div>`);
  msgs.scrollTop=msgs.scrollHeight; inp.value='';
  const loadingId='ld'+Date.now();
  msgs.insertAdjacentHTML('beforeend', `<div id='${loadingId}' class='row bot'><div class='avatar bot'><i class='fas fa-robot'></i></div><div class='bubble'><span style='opacity:.6'>Typing…</span></div></div>`);
  msgs.scrollTop=msgs.scrollHeight;
  try{
    const res=await fetch('/ai/chat',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':getCsrf()},body:JSON.stringify({message:text})});
    const data=await res.json();
    document.getElementById(loadingId)?.remove();
    msgs.insertAdjacentHTML('beforeend', `<div class='row bot'><div class='avatar bot'><i class='fas fa-robot'></i></div><div class='bubble'>${esc(data.reply||'Sorry, something went wrong.')}</div></div>`);
  }catch(err){
    document.getElementById(loadingId)?.remove();
    msgs.insertAdjacentHTML('beforeend', `<div class='row bot'><div class='avatar bot'><i class='fas fa-robot'></i></div><div class='bubble' style='background:#fee2e2;color:#991b1b'>Network error. Please try again.</div></div>`);
  }
  msgs.scrollTop=msgs.scrollHeight; return false;
}
function getCsrf(){
  const m = document.querySelector('meta[name="csrf-token"]');
  return m ? m.getAttribute('content') : '';
}
</script>
</body>
</html>
