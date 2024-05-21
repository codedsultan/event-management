<section class="content">

<div class="public-wrapper">

    <div style="margin-bottom: 15px;">

        <a href="#" target="_blank"
           class="btn btn-primary"><i class="fa fa-print"></i> <span>pdf</span>
        </a>

            <a href="javascript:void(0)" id="btn-notes" data-button-toggle="btn-notes-back" class="btn btn-primary btn-notes">
                <i class="fa fa-comments"></i>notes
            </a>
            <a href="javascript:void(0)" id="btn-notes-back" data-button-toggle="btn-notes" class="btn btn-primary btn-notes" style="display: none;">
                <i class="fa fa-backward"></i>back_to_invoice
            </a>

            <a href="javascript:void(0)" class="btn btn-primary btn-pay" data-driver="#" data-loading-text="@lang('bt.please_wait')"><i class="fa fa-credit-card"></i> pay</a>

    </div>

    <div class="public-doc-wrapper">

        <div id="view-doc">
            <iframe src="#"
                    style="width: 100%;" onload="resizeIframe(this, 800);"></iframe>
        </div>



    </div>

</div>

</section>
