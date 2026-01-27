@extends('frontend.layouts.home')

@section('title', 'Home')

@section('content')

    <div class="styles_bg-orange50__9kFOG">
        <section class="section_section-padding-homepage-hero__BqbM8 section_section___KBXT">
            <div class="container_container___eiAJ container_section-padding-below-nav__qKpFH ">
                <div class="container-fluid">
                    <div class="row start-lg center-xs middle-lg">
                        <div class="col-xs-12 col-lg-6">
                            <h1 class="styles_green800__mnTci">The future-ready HR platform</h1>
                            <p class="styles_neutral800__d6qyT styles_homepage-sub-p__NkKsy">Redefining HR with intelligent tools to streamline hiring, employee data management, time tracking and payroll.</p>
                            <ul class="styles_list-inline-to-bl__2vKXG">
                                <li>
                                    <a class="styles_margin-b-0-sm__kLaP3 links_link__jSvyz links_link-cta-default-xs__iGOVe" target="_self" data-gtm="generic-body-demo" data-ui="homepage-demo" href="/demo">Request a demo</a>
                                </li>
                                <li>
                                    <a class="links_link__jSvyz links_link-primary__b8_AQ" target="_self" data-gtm="generic-body-free-trial" data-ui="homepage-free-trial" href="/free-trial">
                                        <span class="links_foreground__RXsf5">Start a free trial</span>
                                        <span class="links_background-wrapper__10pju">
                                            <span class="links_background__2tzfY"></span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <div class="styles_hero__wrapper__PjM6E">
                                <picture>
                                    <source srcset="/static/images/home/hero/hero-image.webp?v=03cb5f859104f880d0e808bc04de4147 1x, /static/images/home/hero/hero-image_2x.webp?v=03cb5f859104f880d0e808bc04de4147 2x" type="image/webp">
                                    <source srcset="/static/images/home/hero/hero-image.jpg?v=03cb5f859104f880d0e808bc04de4147 1x, /static/images/home/hero/hero-image_2x.jpg?v=03cb5f859104f880d0e808bc04de4147 2x" type="image/jpg">
                                    <img src="/static/images/home/hero/hero-image_2x.jpg?v=03cb5f859104f880d0e808bc04de4147" srcset="/static/images/home/hero/hero-image.jpg?v=03cb5f859104f880d0e808bc04de4147 1x, /static/images/home/hero/hero-image_2x.jpg?v=03cb5f859104f880d0e808bc04de4147 2x" alt="Workable graphic" width="576" height="620" fetchpriority="high" loading="eager">
                                </picture>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
