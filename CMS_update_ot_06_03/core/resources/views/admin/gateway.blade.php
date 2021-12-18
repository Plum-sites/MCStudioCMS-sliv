@extends('admin.layouts.master')
@section('page_icon', 'fa fa-credit-card')
@section('page_name', 'Gateway List')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile">
                <!-- <h3 class="tile-title">Gateways</h3> -->
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('assets/frontend/upload/gateway') }}/{{ $item->id.'.jpg' }}" alt="{{ $item->name }}" width="120px" height="40px">
                            </td>
                            <td>{{ $item->main_name }} </td>
                            <td>{{ $item->name }} </td>
                            <td>
                                @if($item->status == 0)
                                    <b style="color: #b2344c">Deactive</b>
                                    @elseif($item->status == 1)
                                <b style="color: #2ab27b">Active</b>
                                    @endif
                            </td>
                            <td>
                                <button class="btn btn-outline-info gateway_item_edit_btn"
                                        data-toggle="modal"
                                        data-target="#editgetway"
                                        data-id="{{$item->id}}"
                                        data-route="{{route('gateway.list.update', $item->id)}}"
                                        data-name="{{$item->main_name}}"
                                        data-uname="{{$item->name}}"
                                        data-minamo="{{$item->minamo}}"
                                        data-maxamo="{{$item->maxamo}}"
                                        data-fix="{{$item->fixed_charge}}"
                                        data-per="{{$item->percent_charge}}"
                                        data-rate="{{$item->rate}}"
                                        data-val1="{{$item->val1}}"
                                        data-val2="{{$item->val2}}"
                                        data-cur="{{$item->currency}}"
                                        data-status="{{$item->status}}"><i
                                            class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editgetway" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><b>Edit Gateway Details</b></h4>
                </div>
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <form role="form" action="" method="post"
                                  enctype="multipart/form-data" id="gateway-form">
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for=""><b>Name</b></label>
                                        <input type="text" name="main_name" class="form-control form-control-lg"
                                               id="egtname">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Display User Name</b></label>
                                        <input type="text" name="name" class="form-control form-control-lg"
                                               id="egtuname">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Minimum Amount</b></label>
                                        <input type="text" name="minamo" class="form-control form-control-lg"
                                               id="egtminamo">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Maximum Amount</b></label>
                                        <input type="text" name="maxamo" class="form-control form-control-lg"
                                               id="egtmaxamo">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Fixed Charge Per Transaction</b></label>
                                        <input type="text" name="fixed_charge" class="form-control form-control-lg"
                                               id="egtfix">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Percentage Charge Per Transaction</b></label>
                                        <input type="text" name="percent_charge" class="form-control form-control-lg"
                                               id="egtper">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Currency Name</b></label>
                                        <input type="text" id="ecurrency" name="currency" class="form-control form-control-lg">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Currency Rate</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">1 USD =</span>
                                            </div>
                                            <input id="econversion_rate" type="text" class="form-control form-control-lg"
                                                   name="rate" >
                                            <div class="input-group-append">
                                            <span class="input-group-text" id="ebase_cur"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b id="egval1"></b></label>
                                        <input type="text" name="val1" class="form-control form-control-lg"
                                               id="egtval1">
                                    </div>
                                    <div class="form-group" id="dval2">
                                        <label for=""><b id="egval2"></b></label>
                                        <input type="text" name="val2" class="form-control form-control-lg"
                                               id="egtval2">
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> <b>logo
                                                    (Support jpg/jpeg/png only)</b></label>
                                            <input class="form-control form-control-lg" type="file" name="gateimg">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><b>Status</b></label>
                                            <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                                   data-width="100%" type="checkbox" value="1"
                                                   name="status" id="estatus">
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="tile-footer">
                                    <button class="btn btn-primary btn-block btn-lg" type="submit"><i
                                                class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.gateway_item_edit_btn', function () {
                $('#gateway-form').attr('action',$(this).data('route'));
                $('#egtname').val($(this).data('name'));
                $('#egtuname').val($(this).data('uname'));
                $('#econversion_rate').val($(this).data('rate'));
                $('#egtminamo').val($(this).data('minamo'));
                $('#egtmaxamo').val($(this).data('maxamo'));
                $('#egtfix').val($(this).data('fix'));
                $('#egtper').val($(this).data('per'));
                $('#ecurrency').val($(this).data('cur'));
                if ($(this).data('id') == 101){
                    $('#egval1').text("Paypal Business Email");
                    $('#egtval1').val($(this).data('val1'));
                    $('#dval2').hide();
                }else if ($(this).data('id') == 102){
                    $('#egval1').text("Pm USD Account");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("Alternate PassPhrase");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 103) {
                    $('#egval1').text("Secret Key");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("Publishable Key");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 104) {
                    $('#egval1').text("Marchant Email");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("Secret KEY");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 501){
                    $('#egval1').text("API Key");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("XPUB Code");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 502) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("API PIN");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 503) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("API PIN");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 504) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("API PIN");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 505) {
                    $('#egval1').text("Public KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("Private KEY");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 506) {
                    $('#egval1').text("Public KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("Private KEY");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 507) {
                    $('#egval1').text("Public KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("Private KEY");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 508) {
                    $('#egval1').text("Public KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("Private KEY");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 509) {
                    $('#egval1').text("Public KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("Private KEY");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 510) {
                    $('#egval1').text("Public KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("Private KEY");
                    $('#egtval2').val($(this).data('val2'));
                } else if ($(this).data('id') == 512) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#dval2').hide();
                } else if ($(this).data('id') == 513) {
                    $('#egval1').text("API KEY");
                    $('#egtval1').val($(this).data('val1'));
                    $('#egval2').text("API ID");
                    $('#egtval2').val($(this).data('val2'));
                }else{
                    $('#egval1').text("Payment Details");
                    $('#egtval1').val($(this).data('val1'));
                }
                var status = $(this).data('status');
                if(status == 1){
                    $('#estatus').bootstrapToggle('on');
                }else{
                    $('#estatus').bootstrapToggle('off');
                }
                var curtext = $('#ecurrency').val().toUpperCase();
                $('#ebase_cur').text(curtext);
                $('#ecurrency').on("keypress blur click",function () {
                    $('#ebase_cur').text($(this).val().toUpperCase());
                });
            });
        });
    </script>
@endsection