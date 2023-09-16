<!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
<div class="col-md-4 single-note-item all-category">
    <div class="card"  style="background: {{ $note->background }};">
        <a class="text-right position-absolute top-0 end-0 p-2 text-danger" href="javascript:void(0)" onclick="deleteNote({{ $note->id }})">
            <i class="fa fa-remove"></i>
        </a>
        <div class="card-body">
            <span class="side-stick"></span>
            <div class="note-content">
                <p class="note-inner-content text-muted" data-notecontent="{{ $note->content }}">
                    {{ $note->content }}
                </p>
            </div>
        </div>
        <div class="card-footer">
            <p class="text-end small text-muted"><i class="fa fa-calendar"></i> {{ $note->created_at }} ({{ $note->created_at->diffForHumans() }})</p>
        </div>
    </div>
</div>

<form action="/{{ $note->id}}" method="POST" id="delete-form-{{ $note->id }}" style="display: none">
    @method('DELETE')
    @csrf
</form>
