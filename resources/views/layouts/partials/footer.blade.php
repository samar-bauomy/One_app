<!-- start footer -->
<div class="footer py-4">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <form action="{{ route('/home/pops_search') }}" method="get" class="form-inline">
                    {{ method_field('patch') }}
                    @csrf
                    <input type="text" name="keyword" class="form-control mr-sm-2" placeholder="ابحث هنا"
                        aria-label="Search">

                    <button type="submit" class="btn  my-2 my-sm-0">{{ __('بــحــث') }}</button>
                </form>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h1>اشترك معنا واستقبل عروضنا</h1>
            </div>
        </div>

        <?php
            $whats       =\App\Models\Company_Location::pluck('whats')->first();
            $Twitters    = \App\Models\Social_Mail::where('type', 'Twitter')->where('status', '0')->get();
            $Facebooks   = \App\Models\Social_Mail::where('type', 'Facebook')->where('status', '0')->get();
            $YouTubes   = \App\Models\Social_Mail::where('type', 'YouTube')->where('status', '0')->get();
            $Instagrams  = \App\Models\Social_Mail::where('type', 'Instagram')->where('status', '0')->get();
            $G_Mails     = \App\Models\Social_Mail::where('type', 'G_Mail')->where('status', '0')->get();
            $Yahoos      = \App\Models\Social_Mail::where('type', 'Yahoo')->where('status', '0')->get();
            $Telegrams   = \App\Models\Social_Mail::where('type', 'Telegram')->where('status', '0')->get();
            $Linkeds     = \App\Models\Social_Mail::where('type', 'Linked In')->where('status', '0')->get();


            $company_locations = \App\Models\Company_Location::where('status', '0')->get();
        ?>


        <div class="row py-4">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <h3>تواصل</h3>
                <ul>
                    @foreach ($company_locations as $company_location )
                        <li>
                            <a href="{{ $company_location->map_url }}" target="_blank" ><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $company_location->country }} - {{ $company_location->city }} - {{ $company_location->address }}</a>
                        </li>
                    @endforeach

                    @foreach ($company_locations as $company_location )
                        <li>
                            <p><i class="fa fa-phone" aria-hidden="true"></i> {{ $company_location->phone }}</p>
                        </li>
                    @endforeach


                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="text-align: center;">
                <h3>روابط سوشيال ميديا</h3>
                <a href="https://api.whatsapp.com/send?phone={{ $whats }}" target="_blank"  style="color: white; padding-left: 5px;"><i class="fab fa-whatsapp whats"></i></a>

                @foreach ($Facebooks as $Facebook )
                    @if($Facebook->status == '0')
                        <a href="{{ $Facebook->name }}" target="_blank" style="color: white; padding-left: 5px;"><i class="fab fa-facebook"></i></a>
                    @endif
                @endforeach

                @foreach ($Instagrams as $Instagram )
                    @if($Instagram->status == '0')
                        <a href="{{ $Instagram->name }}" target="_blank" style="color: white; padding-left: 5px;"><i class="fab fa-instagram"></i></a>
                    @endif
                @endforeach

                @foreach ($YouTubes as $YouTube )
                    @if($YouTube->status == '0')
                        <a href="{{ $YouTube->name }}" target="_blank" style="color: white; padding-left: 5px;"><i class="fab fa-youtube"></i></a>
                    @endif
                @endforeach

                @foreach ($Twitters as $Twitter )
                    @if($Twitter->status == '0')
                        <a href="{{ $Twitter->name }}" target="_blank" style="color: white; padding-left: 5px;"><i class="fab fa-twitter"></i></a>
                    @endif
                @endforeach


                @foreach ($G_Mails as $G_Mail )
                    @if($G_Mail->status == '0')
                        <a href="{{ $G_Mail->name }}" target="_blank" style="color: white; padding-left: 5px;"><i class="fa fa-envelope"></i></a>
                    @endif
                @endforeach

                @foreach ($Linkeds as $Linked )
                    @if($Linked->status == '0')
                        <a href="{{ $Linked->name }}" target="_blank" style="color: white; padding-left: 5px;"><i class="fab fa-linkedin"></i></a>
                    @endif
                @endforeach

                @foreach ($Yahoos as $Yahoo )
                    @if($Yahoo->status == '0')
                        <a href="{{ $Yahoo->name }}" target="_blank" style="color: white; padding-left: 5px;"><i class="fab fa-yahoo"></i></a>
                    @endif
                @endforeach

                @foreach ($Telegrams as $Telegram )
                    @if($Telegram->status == '0')
                        <a href="{{ $Telegram->name }}" target="_blank" style="color: white; padding-left: 5px;"><i class="fab fa-telegram"></i></a>
                    @endif
                @endforeach
            </div>


            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                @foreach ($company_locations as $company_location )
                    <p class="more-info"><strong>
                        الرقم الضريبي: <span style="color: white; padding-right: 5px;">{{ $company_location->tax_number }}</span>
                    </strong></p>
                    <p class="more-info"><strong>
                            الرقم السجل التجاري: <span style="color: white; padding-right: 5px;">{{ $company_location->trade_number }}</span>
                        </strong></p>
                @endforeach

            </div>

        </div>

    </div>
    <div class="line">

    </div>
    <div class="copy-right text-center">
        <p>
            جميع الحقوق محفوظة  ©️ 2004 - 2021 شيكوبوبوس
        </p>

    </div>

</div>
<!-- end footer -->
