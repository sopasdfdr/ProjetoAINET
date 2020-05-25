<div class="modal fade" id={{$paramId}} tabindex="-1" role="dialog" aria-labelledby="modalMessageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalMessageLabel">{{$title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>{{$text}}</p>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Accept</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </div>
    </div>
</div>
