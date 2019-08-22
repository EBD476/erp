@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
            </button>
            <span> <b> Warning - </b> {{ $error }}</span>
        </div>
    @endforeach
    @endif