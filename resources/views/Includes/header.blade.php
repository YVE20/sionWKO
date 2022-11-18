<div class="row">
    <div class="col-lg-2 float-left" id="logo">
        <div style="padding:11px 0;">
            <div class="row">
                <div class="col-3">
                    <img src="<?= asset('/img/Gereja SION WKO.png') ?>" style="height:100%;width:100%" alt="SionWKO">
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col-12">
                            <font style="font-size:14px;font-weight:bold;"> GEREJA SION WKO </font>
                        </div>
                        <div class="col-12" style="margin-top: -8px;">
                            <font style="font-size:14px;font-weight:bold;"> HALMAHERA UTARA </font>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10 float-left bg-blue-gray" id="header">
        <div class="col-lg-6 float-left">
            <div class="col-lg-8 col-12 float-left">
                <input type="text" class="form-control mt-3" placeholder="Search">
            </div>
        </div>
        <div class="col-lg-6 pt-2 hide float-left text-white">
            <div class="float-right position-relative pt-2 pr-3 username">
                <div class="logout-wrapper"><a href="#">Logout</a></div>
            </div>
            <div class="float-right pt-3 pr-3">
                <font>
                    {{\Carbon\Carbon::now()->isoFormat('dddd, DD MMMM Y')}}
                </font>
            </div>
        </div>
    </div>
</div>