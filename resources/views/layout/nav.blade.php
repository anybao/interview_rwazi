<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Rwazi Note App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{  route('index').'?orderByDate=desc' }}">Sort (latest)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{  route('index').'?orderByDate=asc' }}">Sort (oldest)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="https://github.com/anybao/interview_rwazi" target="_blank"><i class="fa fa-github"></i> Github</a>
                </li>
            </ul>
            <div class="d-flex">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mr-3" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                    <i class="fa fa-plus"></i> Add Note
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addNoteModalLabel">Add Note</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @include('widget.add')
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="submitNote()">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        function submitNote() {
            $('#add-note-form').submit();
        }
    </script>
@endpush
