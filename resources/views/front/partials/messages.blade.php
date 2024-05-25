<link rel="stylesheet" href="/css/messages.css">

@if ($errors->any())
<div id="errorModal" class="modal" style="display: block;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<script src="/js/messages.js"></script>

