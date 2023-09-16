@include('layout.header')

<div class="page-content container note-has-grid">
    <p class="text-muted small">Author: Harry Tran (tranquanghuy1093@gmail.com)</p>

    @include('layout.nav')
    @include('widget.search')
    @include('widget.error')
    <div class="tab-content bg-transparent">
        <div id="note-full-container" class="note-has-grid row">
            @if(count($notes) > 0)
                @foreach($notes as $note)
                    <x-note :note="$note"></x-note>
                @endforeach
            @else
                <p>There are no results.</p>
            @endif
            {{ $notes->withQueryString()->links() }}
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
