<!--slider menu-->
{{-- <div class="sidebar-menu"> --}}
    <div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#">
            <span id="logo"></span>
            <!--<img id="logo" src="" alt="Logo"/>-->
        </a> </div>
    <div class="menu">
        <ul id="menu">
            @if (Auth::user()->level == 'merchant')
                <li id="menu-home"><a href="{{ route('merchant') }}"><i
                            class="fa fa-home"></i><span>Dashboard</span></a></li>
                <li><a href="#"><i class="fa fa-spoon"></i><span>Data Menu</span><span class="fa fa-angle-right"
                            style="float: right"></span></a>
                    <ul>
                        {{-- <li><a href="grids.html">Minuman</a></li> --}}
                        <li><a href="{{ route('DataMakanan') }}">Makanan</a></li>
                    </ul>
                </li>
                <li><a href="maps.html"><i class="fa fa-shopping-cart"></i><span>Daftar Orderan</span></a></li>

                <li><a href="charts.html"><i class="fa fa-file-text"></i><span>Invoice</span></a></li>
            @elseif(Auth::user()->level == 'kantor')
                <li id="menu-home"><a href="{{ route('kantor') }}"><i class="fa fa-home"></i><span>Dashboard</span></a>
                <li><a href="charts.html"><i class="fa fa-file-text"></i><span>Invoice</span></a></li>
                </li>
            @endif

        </ul>
    </div>
{{-- </div> --}}
<div class="clearfix"> </div>
<!--slide bar menu end here-->
<script>
    var toggle = true;

    $(".sidebar-icon").click(function() {
        if (toggle) {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({
                "position": "absolute"
            });
        } else {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function() {
                $("#menu span").css({
                    "position": "relative"
                });
            }, 400);
        }
        toggle = !toggle;
    });
</script>
<!--scrolling js-->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!--//scrolling js-->
<script src="js/bootstrap.js"></script>
<!-- mother grid end here-->
