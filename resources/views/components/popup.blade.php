@if(isset($popups) && !is_null($popups) && count($popups) > 0)
    <div class="modal fade" id="popup-Modal" tabindex="-1" role="dialog" aria-labelledby="popup-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup-ModalLabel">اطلاعیه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($popups as $popup)
                        <div class="row">
                            <h4 class="col-12 text-right">{{$popup->title}}
                                <span class="text-muted text-small persian-numbers">{{$popup->date}}</span>
                            </h4>
                            <div class="col-12 text-justify">{{$popup->body}}</div>
                        </div>
                        <div class="dropdown-divider"></div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
@endif
