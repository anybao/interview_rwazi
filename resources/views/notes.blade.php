@include('layout.header')

<div class="page-content container note-has-grid">
    @include('layout.nav')
    @include('widget.search')
    @include('widget.error')
    <div class="tab-content bg-transparent">
        <div id="note-full-container" class="note-has-grid row">
            @if(count($notes) > 0)
            @foreach($notes as $note)
                @include('widget.view', $note)
            @endforeach
            @else
                <p>There are no results.</p>
            @endif
            {{ $notes->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteNote(id) {
            $('#delete-form-' + id).submit();
        }
    </script>
@endpush
@include('layout.footer')
