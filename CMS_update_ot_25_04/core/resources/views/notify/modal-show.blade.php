@if(@$notify->notify_type == 2)
<div class="modal fade show notify_modal" id="notify_{{ @$notify->id }}" role="basic" data-backdrop="static" data-keyboard="false" style="background:#383838d1 !important;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-left text-black">{{ (!@$notify->subject) ? 'Без темы' : $notify->subject }}</h4>
                <button type="button" class="close notify_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo @$notify->message;
                ?>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 p-0">
                    <div class="float-left text-muted" style="line-height:33px;">
                        С уважением, администратор {{ @$notify->sender->username }}!
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-danger notify_close" data-dismiss="modal">Закрыть</button>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var notify_id = "#notify_{{ @$notify->id }}";
    $(notify_id).modal('show');
    $(notify_id).on('hidden.bs.modal', function (e) {
        notify_close();
    });
</script>
@elseif(@$notify->notify_type == 1)
<script>
    notify_special(
        '<b>{{ @$notify->subject }}</b><br>{{ @$notify->message }}',
        '{{ (!@$notify->timeout) ? 30000 : @$notify->timeout }}',
        '{{ @$notify->type }}'
    );
    $(document).ready(function() {
        notify_active = false;
    });
</script>
@endif