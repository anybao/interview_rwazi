<form id="add-note-form" action="/" method="POST">
    @csrf
    <div class="form-floating">
        <textarea class="form-control" placeholder="Type here..." name="note" id="floatingTextarea2" style="height: 100px"></textarea>
        <label for="floatingTextarea2">What are you thinking about?</label>
    </div>
</form>
