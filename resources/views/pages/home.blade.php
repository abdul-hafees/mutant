@extends('layouts.master')
@section('title', 'Banners')


@section('body')
    <div id="content-container">

        <!-- ==============================
        ///// Begin intro (slideshow) /////
        =============================== -->
        <section id="intro" class="slideshow bg-dark">

            <!-- Begin content carousel (https://owlcarousel2.github.io/OwlCarousel2/)
            ====================================================================
            * Use class "nav-outside" for outside nav.
            * Use class "nav-outside-top" for outside top nav.
            * Use class "nav-bottom-right" for bottom right nav.
            * Use class "nav-rounded" for rounded nav.
            * Use class "dots-outside" for outside dots.
            * Use class "dots-left" or "dots-right" to align dots.
            * Use class "dots-rounded" for rounded dots.
            * Use class "owl-mousewheel" to enable mousewheel support.
            * Available carousel data attributes:
                    data-items="5".......................(items visible on desktop)
                    data-tablet-landscape="4"............(items visible on mobiles)
                    data-tablet-portrait="3".............(items visible on mobiles)
                    data-mobile-landscape="2"............(items visible on tablets)
                    data-mobile-portrait="1".............(items visible on tablets)
                    data-loop="true".....................(true/false)
                    data-margin="10".....................(space between items)
                    data-center="true"...................(true/false)
                    data-start-position="0"..............(item start position)
                    data-animate-in="fadeIn".............(fade-in animation)
                    data-animate-out="fadeOut"...........(fade-out animation)
                    data-mouse-drag="false"..............(true/false)
                    data-touch-drag="false"..............(true/false)
                    data-autoheight="true"...............(true/false)
                    data-autoplay="true".................(true/false)
                    data-autoplay-timeout="5000".........(milliseconds)
                    data-autoplay-hover-pause="true".....(true/false)
                    data-autoplay-speed="800"............(milliseconds)
                    data-drag-end-speed="800"............(milliseconds)
                    data-nav="true"......................(true/false)
                    data-nav-speed="800".................(milliseconds)
                    data-dots="false"....................(true/false)
                    data-dots-speed="800"................(milliseconds)
            -->
            <div class="owl-carousel cursor-grab fade-out-scroll-5 nav-bottom-right" data-items="1" data-dots="false"
                 data-nav="true">

                <!-- Begin carousel item
                ========================= -->
                <div class="cc-item parallax bg-image"
                     style="background-image: url({{ \App\Helpers\Helper::getValue('wallpaper_1') }}); background-position: 50% 50%;"
                     data-percent-height="0.9">

                    <!-- Begin caption -->
                    <div class="cc-caption intro-caption bottom-left caption-animate">
                        <h1 class="intro-title">{{ \App\Helpers\Helper::getValue('wallpaper_1_title') }}</h1>
                        <div class="intro-sub-title-wrap max-width-400"> <!-- max width class is optional -->
                            <h2 class="intro-sub-title">
                                {{ \App\Helpers\Helper::getValue('wallpaper_1_description') }}
                            </h2>
                        </div>
                    </div>
                    <!-- End caption -->

                </div>
                <!-- End carousel item -->

                <!-- Begin carousel item
                ========================= -->
                <div class="cc-item parallax bg-image"
                     style="background-image: url({{ \App\Helpers\Helper::getValue('wallpaper_2') }}); background-position: 50% 50%;"
                     data-percent-height="0.9">

                    <!-- Begin caption -->
                    <div class="cc-caption intro-caption bottom-left caption-animate">
                        <h1 class="intro-title">{{ \App\Helpers\Helper::getValue('wallpaper_2_title') }}</h1>
                        <div class="intro-sub-title-wrap">
                            <h2 class="intro-sub-title">
                                {{ \App\Helpers\Helper::getValue('wallpaper_2_description') }}
                            </h2>
                        </div>
                    </div>
                    <!-- End caption -->

                </div>
                <!-- End carousel item -->

                <!-- Begin carousel item
                ========================= -->
                <div class="cc-item parallax bg-image"
                     style="background-image: url({{ \App\Helpers\Helper::getValue('wallpaper_3') }}); background-position: 50% 55%;"
                     data-percent-height="0.9">

                    <!-- Begin caption -->
                    <div class="cc-caption intro-caption bottom-left caption-animate">
                        <h1 class="intro-title">{{ \App\Helpers\Helper::getValue('wallpaper_3_title') }}</h1>
                        <div class="intro-sub-title-wrap">
                            <h2 class="intro-sub-title">
                                {{ \App\Helpers\Helper::getValue('wallpaper_3_description') }}
                            </h2>
                        </div>
                    </div>
                    <!-- End caption -->

                </div>
                <!-- End carousel item -->

                <!-- Begin carousel item
                ========================= -->
                <!-- <div class="cc-item parallax" data-percent-height="0.9">

                    <a class="owl-video" href="https://vimeo.com/99653121"></a>

                    <div class="cc-caption bottom-left">
                        <h1 class="intro-title">Print Designer<br>Michael Smith</h1>
                    </div>

                </div> -->
                <!-- End carousel item -->

            </div>
            <!-- End content carousel -->

        </section>
        <!-- End intro -->


        <!-- ===================================
        ///// Begin portfolio list section /////
        ==================================== -->
        <section id="portfolio-list-section">
            <div class="isotope-wrap">

                <!-- Begin isotope
                ===================
                * Use class "gutter-1", "gutter-2" or "gutter-3" to add more space between items.
                * Use class "col-1", "col-2", "col-3", "col-4", "col-5" or "col-6" for columns.
                -->
                <div class="isotope col-3">

                    <!-- Begin isotope items wrap
                    ==============================
                    * Use class "iso-boxed" to enable boxed layout.
                    * Use class "pli-caption-center" to enable caption center position.
                    * Use class "pli-caption-alter" to enable caption alternative style.
                    -->
                    <div class="isotope-items-wrap pli-caption-alter">

                        <!-- Grid sizer (do not remove!!!) -->
                        <div class="grid-sizer"></div>


                        <!-- =====================
                        /// Begin isotope item ///
                        ==========================
                        * If you use background image on isotope-item child element, then you need to use class "iso-height-1" or "iso-height-2" to set the item height. If you use simple image tag, then don't use height classes.
                        -->
                        <div class="isotope-item iso-height-2">

                            <!-- Begin portfolio list item -->
                            <a href="portfolio-single-1.html" class="portfolio-list-item bg-image"
                               style="background-image: url({{ \App\Helpers\Helper::getValue('gallery_1') }}); background-position: 50% 50%">
                                <div class="pli-hover">
                                    <div class="pli-caption">
                                        <div><h2 class="pli-title">{{ \App\Helpers\Helper::getValue('gallery_1_title') }}</h2></div>
                                        <div><span class="pli-category">Print</span></div>
                                    </div>
                                    <div class="pli-arrow"></div>
                                </div>
                            </a>
                            <!-- End portfolio list item -->

                        </div>
                        <!-- End isotope item -->

                        <!-- =====================
                        /// Begin isotope item ///
                        ==========================
                        * If you use background image on isotope-item child element, then you need to use class "iso-height-1" or "iso-height-2" to set the item height. If you use simple image tag, then don't use height classes.
                        -->
                        <div class="isotope-item iso-height-1">

                            <!-- Begin portfolio list item -->
                            <a href="portfolio-single-2.html" class="portfolio-list-item bg-image"
                               style="background-image: url({{ \App\Helpers\Helper::getValue('gallery_2') }}); background-position: 50% 50%">
                                <div class="pli-hover">
                                    <div class="pli-caption">
                                        <div><h2 class="pli-title">{{ \App\Helpers\Helper::getValue('gallery_2_title') }}</h2></div>
                                        <div><span class="pli-category">Print, Motion</span></div>
                                    </div>
                                    <div class="pli-arrow"></div>
                                </div>
                            </a>
                            <!-- End portfolio list item -->

                        </div>
                        <!-- End isotope item -->

                        <!-- =====================
                        /// Begin isotope item ///
                        ==========================
                        * If you use background image on isotope-item child element, then you need to use class "iso-height-1" or "iso-height-2" to set the item height. If you use simple image tag, then don't use height classes.
                        -->
                        <div class="isotope-item iso-height-1">

                            <!-- Begin portfolio list item -->
                            <a href="portfolio-single-3.html" class="portfolio-list-item bg-image"
                               style="background-image: url({{ \App\Helpers\Helper::getValue('gallery_3') }}); background-position: 50% 50%">
                                <div class="pli-hover">
                                    <div class="pli-caption">
                                        <div><h2 class="pli-title">{{ \App\Helpers\Helper::getValue('gallery_3_title') }}</h2></div>
                                        <div><span class="pli-category">Print</span></div>
                                    </div>
                                    <div class="pli-arrow"></div>
                                </div>
                            </a>
                            <!-- End portfolio list item -->

                        </div>
                        <!-- End isotope item -->

                        <!-- =====================
                        /// Begin isotope item ///
                        ==========================
                        * If you use background image on isotope-item child element, then you need to use class "iso-height-1" or "iso-height-2" to set the item height. If you use simple image tag, then don't use height classes.
                        -->
                        <div class="isotope-item iso-height-1">

                            <!-- Begin portfolio list item -->
                            <a href="portfolio-single-4.html" class="portfolio-list-item bg-image"
                               style="background-image: url({{ \App\Helpers\Helper::getValue('gallery_4') }}); background-position: 50% 50%">
                                <div class="pli-hover">
                                    <div class="pli-caption">
                                        <div><h2 class="pli-title">{{ \App\Helpers\Helper::getValue('gallery_4_title') }}</h2></div>
                                        <div><span class="pli-category">Print</span></div>
                                    </div>
                                    <div class="pli-arrow"></div>
                                </div>
                            </a>
                            <!-- End portfolio list item -->

                        </div>
                        <!-- End isotope item -->

                        <!-- =====================
                        /// Begin isotope item ///
                        ==========================
                        * If you use background image on isotope-item child element, then you need to use class "iso-height-1" or "iso-height-2" to set the item height. If you use simple image tag, then don't use height classes.
                        -->
                        <div class="isotope-item iso-height-2">

                            <!-- Begin portfolio list item -->
                            <a href="portfolio-single-5.html" class="portfolio-list-item bg-image"
                               style="background-image: url({{ \App\Helpers\Helper::getValue('gallery_5') }}); background-position: 50% 50%">
                                <div class="pli-hover">
                                    <div class="pli-caption">
                                        <div><h2 class="pli-title">{{ \App\Helpers\Helper::getValue('gallery_5_title') }}</h2></div>
                                        <div><span class="pli-category">Web Design, Motion</span></div>
                                    </div>
                                    <div class="pli-arrow"></div>
                                </div>
                            </a>
                            <!-- End portfolio list item -->

                        </div>
                        <!-- End isotope item -->

                        <!-- =====================
                        /// Begin isotope item ///
                        ==========================
                        * If you use background image on isotope-item child element, then you need to use class "iso-height-1" or "iso-height-2" to set the item height. If you use simple image tag, then don't use height classes.
                        -->
                        <div class="isotope-item iso-height-2">

                            <!-- Begin portfolio list item -->
                            <a href="portfolio-single-2.html" class="portfolio-list-item bg-image"
                               style="background-image: url({{ \App\Helpers\Helper::getValue('gallery_6') }}); background-position: 50% 50%">
                                <div class="pli-hover">
                                    <div class="pli-caption">
                                        <div><h2 class="pli-title">{{ \App\Helpers\Helper::getValue('gallery_6_title') }}</h2></div>
                                        <div><span class="pli-category">Web Design</span></div>
                                    </div>
                                    <div class="pli-arrow"></div>
                                </div>
                            </a>
                            <!-- End portfolio list item -->

                        </div>
                        <!-- End isotope item -->

                        <!-- =====================
                        /// Begin isotope item ///
                        ==========================
                        * If you use background image on isotope-item child element, then you need to use class "iso-height-1" or "iso-height-2" to set the item height. If you use simple image tag, then don't use height classes.
                        -->
                        <div class="isotope-item iso-height-1">

                            <!-- Begin portfolio list item -->
                            <a href="portfolio-single-6.html" class="portfolio-list-item bg-image"
                               style="background-image: url({{ \App\Helpers\Helper::getValue('gallery_7') }}); background-position: 50% 50%">
                                <div class="pli-hover">
                                    <div class="pli-caption">
                                        <div><h2 class="pli-title">{{ \App\Helpers\Helper::getValue('gallery_7_title') }}</h2></div>
                                        <div><span class="pli-category">Photography</span></div>
                                    </div>
                                    <div class="pli-arrow"></div>
                                </div>
                            </a>
                            <!-- End portfolio list item -->

                        </div>
                        <!-- End isotope item -->

                        <!-- =====================
                        /// Begin isotope item ///
                        ==========================
                        * If you use background image on isotope-item child element, then you need to use class "iso-height-1" or "iso-height-2" to set the item height. If you use simple image tag, then don't use height classes.
                        -->
                        <div class="isotope-item iso-height-1">

                            <!-- Begin portfolio list item -->
                            <a href="portfolio-single-3.html" class="portfolio-list-item bg-image"
                               style="background-image: url({{ \App\Helpers\Helper::getValue('gallery_8') }}); background-position: 50% 50%">
                                <div class="pli-hover">
                                    <div class="pli-caption">
                                        <div><h2 class="pli-title">{{ \App\Helpers\Helper::getValue('gallery_8_title') }}</h2></div>
                                        <div><span class="pli-category">Photography</span></div>
                                    </div>
                                    <div class="pli-arrow"></div>
                                </div>
                            </a>
                            <!-- End portfolio list item -->

                        </div>
                        <!-- End isotope item -->

                        <!-- =====================
                        /// Begin isotope item ///
                        ==========================
                        * If you use background image on isotope-item child element, then you need to use class "iso-height-1" or "iso-height-2" to set the item height. If you use simple image tag, then don't use height classes.
                        -->
                        <div class="isotope-item iso-height-1">

                            <!-- Begin portfolio list item -->
                            <a href="portfolio-single-4.html" class="portfolio-list-item bg-image"
                               style="background-image: url({{ \App\Helpers\Helper::getValue('gallery_9') }}); background-position: 50% 50%">
                                <div class="pli-hover">
                                    <div class="pli-caption">
                                        <div><h2 class="pli-title">{{ \App\Helpers\Helper::getValue('gallery_9_title') }}</h2></div>
                                        <div><span class="pli-category">Photography, Motion</span></div>
                                    </div>
                                    <div class="pli-arrow"></div>
                                </div>
                            </a>
                            <!-- End portfolio list item -->

                        </div>
                        <!-- End isotope item -->

                    </div>
                    <!-- End isotope items wrap -->

                </div>
                <!-- End isotope -->

            </div> <!-- /.isotope-wrap -->
        </section>
        <!-- End section -->

    </div>

@endsection
