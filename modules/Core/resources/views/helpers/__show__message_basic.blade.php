<div class="text-danger error-message" style="display: block">
    @if(session("error"))
        {{ session("error") }}
    @endif
</div>

<div class="text-success success-message" style="display: block">
    @if(session("success"))
        {{ session("success") }}
    @endif
</div>