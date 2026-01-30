var jqueryScript = document.createElement('script');
jqueryScript.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
document.head.appendChild(jqueryScript);

(function($) {
    "use strict";
    function starsOutput(firstStar, secondStar, thirdStar, fourthStar, fifthStar) {
        return "" + '<span class="' + firstStar + '"></span>' + '<span class="' + secondStar + '"></span>' + '<span class="' + thirdStar + '"></span>' + '<span class="' + fourthStar + '"></span>' + '<span class="' + fifthStar + '"></span>';
    }
    $.fn.numericalRating = function() {
        this.each(function() {
            var dataRating = $(this).attr("data-rating");
            if (dataRating >= 4) {
                $(this).addClass("high");
            } else if (dataRating >= 3) {
                $(this).addClass("mid");
            } else if (dataRating < 3) {
                $(this).addClass("low");
            }
        });
    };
    $.fn.starRating = function() {
        this.each(function() {
            var dataRating = $(this).attr("data-rating");
            if (dataRating > 0) {
                var fiveStars = starsOutput("star", "star", "star", "star", "star");
                var fourHalfStars = starsOutput("star", "star", "star", "star", "star half");
                var fourStars = starsOutput("star", "star", "star", "star", "star empty");
                var threeHalfStars = starsOutput("star", "star", "star", "star half", "star empty");
                var threeStars = starsOutput("star", "star", "star", "star empty", "star empty");
                var twoHalfStars = starsOutput("star", "star", "star half", "star empty", "star empty");
                var twoStars = starsOutput("star", "star", "star empty", "star empty", "star empty");
                var oneHalfStar = starsOutput("star", "star half", "star empty", "star empty", "star empty");
                var oneStar = starsOutput("star", "star empty", "star empty", "star empty", "star empty");
                if (dataRating >= 4.75) {
                    $(this).append(fiveStars);
                } else if (dataRating >= 4.25) {
                    $(this).append(fourHalfStars);
                } else if (dataRating >= 3.75) {
                    $(this).append(fourStars);
                } else if (dataRating >= 3.25) {
                    $(this).append(threeHalfStars);
                } else if (dataRating >= 2.75) {
                    $(this).append(threeStars);
                } else if (dataRating >= 2.25) {
                    $(this).append(twoHalfStars);
                } else if (dataRating >= 1.75) {
                    $(this).append(twoStars);
                } else if (dataRating >= 1.25) {
                    $(this).append(oneHalfStar);
                } else if (dataRating < 1.25) {
                    $(this).append(oneStar);
                }
            }
        });
    };
})(jQuery);

(function($) {
    "use strict";
    $(document).ready(function() {
        $(function() {
            function mmenuInit() {
                var wi = $(window).width();
                if (wi <= "1920") {
                    $("#mmenu-init").remove();
                    $("#navigation").clone().addClass("mmenu-init").insertBefore("#navigation").removeAttr('id').removeClass('style-1 style-2').find('ul').removeAttr('id');
                    $(".mmenu-init").mmenu({
                        counters: !0,
                        navbar: {
                            title: listeo_core.mmenuTitle
                        }
                    }, {
                        offCanvas: {
                            pageNodetype: "#wrapper"
                        }
                    });
                    var mmenuAPI = $(".mmenu-init").data("mmenu");
                    var $icon = $(".hamburger");
                    mmenuAPI.close();
                    $icon.removeClass("is-active");
                    $(".mmenu-trigger").click(function() {
                        mmenuAPI.open();
                    });
                    mmenuAPI.bind("open:finish", function() {
                        setTimeout(function() {
                            $icon.addClass("is-active");
                        });
                    });
                    mmenuAPI.bind("close:finish", function() {
                        setTimeout(function() {
                            $icon.removeClass("is-active");
                        });
                    });
                }
                $(".mm-next").addClass("mm-fullsubopen");
            }
            mmenuInit();
            $(window).resize(function() {
                mmenuInit();
            });
        });
        $(".stars a").on("click", function() {
            $(".stars a").removeClass("prevactive");
            $(this).prevAll().addClass("prevactive");
        }).hover(function() {
            $(".stars a").removeClass("prevactive");
            $(this).addClass("prevactive").prevAll().addClass("prevactive");
        }, function() {
            $(".stars a").removeClass("prevactive");
            $(".stars a.active").prevAll().addClass("prevactive");
        });
        $("body").on("click", ".user-menu", function() {
            $(this).toggleClass("active");
        });
        var user_mouse_is_inside = !1;
        $("body").on("mouseenter", ".user-menu", function() {
            user_mouse_is_inside = !0;
        });
        $("body").on("mouseleave", ".user-menu", function() {
            user_mouse_is_inside = !1;
        });
        $("body").mouseup(function() {
            if (!user_mouse_is_inside) $(".user-menu").removeClass("active");
        });
        if ($("#header-container").hasClass("sticky-header")) {
            $("#header").not("#header.not-sticky").clone(!0).addClass("cloned unsticky").insertAfter("#header");
            var reg_logo = $("#header.cloned #logo").data("logo-sticky");
            $("#header.cloned #logo img").attr("src", reg_logo);
            var headerOffset = 100;
            $(window).scroll(function() {
                if ($(window).scrollTop() > headerOffset) {
                    $("#header.cloned").addClass("sticky").removeClass("unsticky");
                    $("#navigation.style-2.cloned").addClass("sticky").removeClass("unsticky");
                } else {
                    $("#header.cloned").addClass("unsticky").removeClass("sticky");
                    $("#navigation.style-2.cloned").addClass("unsticky").removeClass("sticky");
                }
            });
        }
        $(document.body).on("added_to_cart", function() {
            $("body").addClass("listeo_adding_to_cart");
            setTimeout(function() {
                $("body").removeClass("listeo_adding_to_cart");
            }, 2e3);
        });
        var pxShow = 600;
        var scrollSpeed = 500;
        $(window).scroll(function() {
            if ($(window).scrollTop() >= pxShow) {
                $("#backtotop").addClass("visible");
            } else {
                $("#backtotop").removeClass("visible");
            }
        });
        $("#backtotop a").on("click", function() {
            $("html, body").animate({
                scrollTop: 0
            }, scrollSpeed);
            return !1;
        });
        function inlineCSS() {
            $(".main-search-container, section.fullwidth, .listing-slider .item, .listing-slider-small .item, .address-container, .img-box-background, .image-edge, .edge-bg").each(function() {
                var attrImageBG = $(this).attr("data-background-image");
                var attrColorBG = $(this).attr("data-background-color");
                if (attrImageBG !== undefined) {
                    $(this).css("background-image", "url(" + attrImageBG + ")");
                }
                if (attrColorBG !== undefined) {
                    $(this).css("background", "" + attrColorBG + "");
                }
            });
        }
        inlineCSS();
        function parallaxBG() {
            $(".parallax,.vc_parallax").prepend('<div class="parallax-overlay"></div>');
            $(".parallax,.vc_parallax").each(function() {
                var attrImage = $(this).attr("data-background");
                var attrColor = $(this).attr("data-color");
                var attrOpacity = $(this).attr("data-color-opacity");
                if (attrImage !== undefined) {
                    $(this).css("background-image", "url(" + attrImage + ")");
                }
                if (attrColor !== undefined) {
                    $(this).find(".parallax-overlay").css("background-color", "" + attrColor + "");
                }
                if (attrOpacity !== undefined) {
                    $(this).find(".parallax-overlay").css("opacity", "" + attrOpacity + "");
                }
            });
        }
        parallaxBG();
        $(".category-box").each(function() {
            $(this).append('<div class="category-box-background"></div>');
            $(this).children(".category-box-background").css({
                "background-image": "url(" + $(this).attr("data-background-image") + ")"
            });
        });
        $(".img-box").each(function() {
            $(this).append('<div class="img-box-background"></div>');
            $(this).children(".img-box-background").css({
                "background-image": "url(" + $(this).attr("data-background-image") + ")"
            });
        });
        if ("ontouchstart" in window) {
            document.documentElement.className = document.documentElement.className + " touch";
        }
        if (!$("html").hasClass("touch")) {
            $(".parallax").css("background-attachment", "fixed");
        }
        function fullscreenFix() {
            var h = $("body").height();
            $(".content-b").each(function(i) {
                if ($(this).innerHeight() > h) {
                    $(this).closest(".fullscreen").addClass("overflow");
                }
            });
        }
        $(window).resize(fullscreenFix);
        fullscreenFix();
        function backgroundResize() {
            var windowH = $(window).height();
            $(".parallax").each(function(i) {
                var path = $(this);
                var contW = path.width();
                var contH = path.height();
                var imgW = path.attr("data-img-width");
                var imgH = path.attr("data-img-height");
                var ratio = imgW / imgH;
                var diff = 100;
                diff = diff ? diff : 0;
                var remainingH = 0;
                if (path.hasClass("parallax") && !$("html").hasClass("touch")) {
                    remainingH = windowH - contH;
                }
                imgH = contH + remainingH + diff;
                imgW = imgH * ratio;
                if (contW > imgW) {
                    imgW = contW;
                    imgH = imgW / ratio;
                }
                path.data("resized-imgW", imgW);
                path.data("resized-imgH", imgH);
                path.css("background-size", imgW + "px " + imgH + "px");
            });
        }
        $(window).resize(backgroundResize);
        $(window).focus(backgroundResize);
        backgroundResize();
        function parallaxPosition(e) {
            var heightWindow = $(window).height();
            var topWindow = $(window).scrollTop();
            var bottomWindow = topWindow + heightWindow;
            var currentWindow = (topWindow + bottomWindow) / 2;
            $(".parallax").each(function(i) {
                var path = $(this);
                var height = path.height();
                var top = path.offset().top;
                var bottom = top + height;
                if (bottomWindow > top && topWindow < bottom) {
                    var imgH = path.data("resized-imgH");
                    var min = 0;
                    var max = -imgH + heightWindow;
                    var overflowH = height < heightWindow ? imgH - height : imgH - heightWindow;
                    top = top - overflowH;
                    bottom = bottom + overflowH;
                    var value = 0;
                    if ($(".parallax").is(".titlebar")) {
                        value = min + (max - min) * (currentWindow - top) / (bottom - top) * 2;
                    } else {
                        value = min + (max - min) * (currentWindow - top) / (bottom - top);
                    }
                    var orizontalPosition = path.attr("data-oriz-pos");
                    orizontalPosition = orizontalPosition ? orizontalPosition : "50%";
                    $(this).css("background-position", orizontalPosition + " " + value + "px");
                }
            });
        }
        if (!$("html").hasClass("touch")) {
            $(window).resize(parallaxPosition);
            $(window).scroll(parallaxPosition);
            parallaxPosition();
        }
        if (navigator.userAgent.match(/Trident\/7\./)) {
            $("body").on("mousewheel", function() {
                event.preventDefault();
                var wheelDelta = event.wheelDelta;
                var currentScrollPosition = window.pageYOffset;
                window.scrollTo(0, currentScrollPosition - wheelDelta);
            });
        }
        $(".dokan-store-products-filter-area select").select2({
            dropdownPosition: "below",
            dropdownParent: $(".dokan-store-products-ordeby-select"),
            minimumResultsForSearch: 20,
            width: "100%",
            placeholder: $(this).data("placeholder"),
            language: {
                noResults: function(term) {
                    return listeo_core.no_results_text;
                }
            }
        });
        $(".select2-single,.woocommerce-ordering select,.dokan-form-group select,#stores_orderby").select2({
            dropdownPosition: "below",
            minimumResultsForSearch: 20,
            width: "100%",
            placeholder: $(this).data("placeholder"),
            language: {
                noResults: function(term) {
                    return listeo_core.no_results_text;
                }
            }
        });
        $(".select2-multiple").each(function() {
            $(this).select2({
                dropdownPosition: "below",
                width: "100%",
                placeholder: $(this).data("placeholder"),
                language: {
                    noResults: function(term) {
                        return listeo_core.no_results_text;
                    }
                }
            });
        });
        $(".main-search-inner .select2-single").select2({
            minimumResultsForSearch: 20,
            dropdownPosition: "below",
            width: "100%",
            dropdownParent: $(".main-search-input"),
            language: {
                noResults: function(term) {
                    return listeo_core.no_results_text;
                }
            }
        });
        $(".main-search-inner .select2-multiple").each(function() {
            $(this).select2({
                width: "100%",
                dropdownPosition: "below",
                placeholder: $(this).data("placeholder"),
                dropdownParent: $(".main-search-input"),
                language: {
                    noResults: function(term) {
                        return listeo_core.no_results_text;
                    }
                }
            });
        });
        $(".select2-sortby").select2({
            dropdownParent: $(".sort-by"),
            minimumResultsForSearch: 20,
            width: "100%",
            dropdownPosition: "below",
            placeholder: $(this).data("placeholder"),
            language: {
                noResults: function(term) {
                    return listeo_core.no_results_text;
                }
            }
        });
        $(".select2-bookings").select2({
            dropdownParent: $(".sort-by"),
            minimumResultsForSearch: 20,
            width: "100%",
            dropdownPosition: "below",
            placeholder: $(this).data("placeholder"),
            language: {
                noResults: function(term) {
                    return listeo_core.no_results_text;
                }
            }
        });
        $(".select2-bookings-status").select2({
            dropdownParent: $(".sort-by-status"),
            minimumResultsForSearch: 20,
            width: "100%",
            dropdownPosition: "below",
            placeholder: $(this).data("placeholder"),
            language: {
                noResults: function(term) {
                    return listeo_core.no_results_text;
                }
            }
        });
        $(".select2-bookings-author").select2({
            dropdownParent: $(".sort-by-booking-author"),
            minimumResultsForSearch: 20,
            dropdownPosition: "below",
            placeholder: $(this).data("placeholder"),
            language: {
                noResults: function(term) {
                    return listeo_core.no_results_text;
                }
            }
        });
        $(".mfp-gallery-container").each(function() {
            $(this).magnificPopup({
                type: "image",
                delegate: "a.mfp-gallery",
                fixedContentPos: !0,
                fixedBgPos: !0,
                overflowY: "auto",
                closeBtnInside: !1,
                preloader: !0,
                removalDelay: 0,
                mainClass: "mfp-fade",
                gallery: {
                    enabled: !0,
                    tCounter: ""
                }
            });
        });
        $(".popup-with-zoom-anim").magnificPopup({
            type: "inline",
            fixedContentPos: !1,
            fixedBgPos: !0,
            overflowY: "auto",
            closeBtnInside: !0,
            preloader: !1,
            midClick: !0,
            removalDelay: 300,
            mainClass: "my-mfp-zoom-in"
        });
        $(".mfp-image").magnificPopup({
            type: "image",
            closeOnContentClick: !0,
            mainClass: "mfp-fade",
            image: {
                verticalFit: !0
            },
            zoom: {
                enabled: !0,
                duration: 300,
                easing: "ease-in-out",
                opener: function(openerElement) {
                    return openerElement.is("img") ? openerElement : openerElement.find("img");
                }
            }
        });
        $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
            disableOn: 700,
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: !1,
            fixedContentPos: !1
        });
        $(".home-search-carousel, .simple-slick-carousel, .simple-fw-slick-carousel, .testimonial-carousel, .fullwidth-slick-carousel").append("" + "<div class='slider-controls-container'>" + "<div class='slider-controls'>" + "<button type='button' class='slide-m-prev'></button>" + "<div class='slide-m-dots'></div>" + "<button type='button' class='slide-m-next'></button>" + "</div>" + "</div>");
        $(".home-search-carousel").each(function() {
            $(this).slick({
                slide: ".home-search-slide",
                centerMode: !0,
                centerPadding: "15%",
                slidesToShow: 1,
                dots: !0,
                arrows: !0,
                appendDots: $(this).find(".slide-m-dots"),
                prevArrow: $(this).find(".slide-m-prev"),
                nextArrow: $(this).find(".slide-m-next"),
                responsive: [ {
                    breakpoint: 1940,
                    settings: {
                        centerPadding: "13%",
                        slidesToShow: 1
                    }
                }, {
                    breakpoint: 1640,
                    settings: {
                        centerPadding: "8%",
                        slidesToShow: 1
                    }
                }, {
                    breakpoint: 1430,
                    settings: {
                        centerPadding: "50px",
                        slidesToShow: 1
                    }
                }, {
                    breakpoint: 1370,
                    settings: {
                        centerPadding: "20px",
                        slidesToShow: 1
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        centerPadding: "20px",
                        slidesToShow: 1
                    }
                } ]
            });
        });
        if (document.readyState == "complete") {
            init7Slider();
        }
        function init7Slider() {
            $(".home-search-slider-headlines").each(function() {
                var carouselHeadlineHeight = $(this).height();
                $(this).css("padding-bottom", carouselHeadlineHeight + 30);
            });
            $(".home-search-carousel").removeClass("carousel-not-ready");
            $(".home-search-carousel-placeholder").addClass("carousel-ready");
            if ($(window).width() < 992) {
                $(".home-search-slider-headlines").each(function() {
                    $(this).css("bottom", $(".main-search-input").height() + 65);
                });
            }
        }
        $(window).on("load", function() {
            init7Slider();
        });
        $(window).on("load resize", function() {
            if ($(window).width() < 992) {
                $(".home-search-slider-headlines").each(function() {
                    $(this).css("bottom", $(".main-search-input").height() + 65);
                });
                $('#main-information .main-information-buttons').prependTo("#main-information");
            } else {
                $('#main-information .main-information-buttons').appendTo("#main-information");
            }
        });
        $(".fullwidth-slick-carousel").each(function() {
            $(this).slick({
                centerMode: !0,
                centerPadding: "20%",
                slidesToShow: 3,
                dots: !0,
                arrows: !0,
                slide: ".fw-carousel-item",
                appendDots: $(this).find(".slide-m-dots"),
                prevArrow: $(this).find(".slide-m-prev"),
                nextArrow: $(this).find(".slide-m-next"),
                responsive: [ {
                    breakpoint: 1920,
                    settings: {
                        centerPadding: "15%",
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 1441,
                    settings: {
                        centerPadding: "10%",
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 1025,
                    settings: {
                        centerPadding: "10px",
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        centerPadding: "10px",
                        slidesToShow: 1
                    }
                } ]
            });
        });
        $(".testimonial-carousel").each(function() {
            $(this).slick({
                centerMode: !0,
                centerPadding: "34%",
                slidesToShow: 1,
                dots: !0,
                arrows: !0,
                slide: ".fw-carousel-review",
                appendDots: $(this).find(".slide-m-dots"),
                prevArrow: $(this).find(".slide-m-prev"),
                nextArrow: $(this).find(".slide-m-next"),
                responsive: [ {
                    breakpoint: 1025,
                    settings: {
                        centerPadding: "10px",
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        centerPadding: "10px",
                        slidesToShow: 1
                    }
                } ]
            });
        });
        $(".listing-slider").slick({
            centerMode: !0,
            centerPadding: "20%",
            slidesToShow: 2,
            responsive: [ {
                breakpoint: 1367,
                settings: {
                    centerPadding: "15%"
                }
            }, {
                breakpoint: 1025,
                settings: {
                    centerPadding: "0"
                }
            }, {
                breakpoint: 767,
                settings: {
                    centerPadding: "0",
                    slidesToShow: 1
                }
            } ]
        });
        $(".widget-listing-slider").slick({
            dots: !0,
            infinite: !0,
            arrows: !1,
            slidesToShow: 1
        });
        $(".listing-slider-small").slick({
            centerMode: !0,
            centerPadding: "0",
            slidesToShow: 3,
            responsive: [ {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1
                }
            } ]
        });
        $(".simple-slick-carousel").each(function() {
            var slides = $(this).data("slides");
            if (!slides) {
                slides = 3;
            }
            if ($("body").hasClass("page-template-template-dashboard")) {
                slides = 4;
            }
            $(this).slick({
                infinite: !0,
                slidesToShow: slides,
                slidesToScroll: 3,
                // centerMode: true,
                // centerPadding: '60px',
                slide: ".fw-carousel-item",
                dots: !0,
                arrows: !0,
                appendDots: $(this).find(".slide-m-dots"),
                prevArrow: $(this).find(".slide-m-prev"),
                nextArrow: $(this).find(".slide-m-next"),
                responsive: [ 
/*                    
                    {
                        breakpoint: 1360,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },                  
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    } 
*/                    
                    {
                        breakpoint: 1367,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5
                        }
                    },
                    {
                        breakpoint: 1240,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 300,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            }).on("init", function(e, slick) {});
        });
        $(".simple-fw-slick-carousel").each(function() {
            var slides = $(this).data("slides");
            if (!slides) {
                slides = 5;
            }
            $(this).slick({
                infinite: !0,
                slidesToShow: slides,
                slidesToScroll: 1,
                dots: !0,
                arrows: !0,
                slide: ".fw-carousel-item",
                appendDots: $(this).find(".slide-m-dots"),
                prevArrow: $(this).find(".slide-m-prev"),
                nextArrow: $(this).find(".slide-m-next"),
                responsive: [ {
                    breakpoint: 1610,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 1365,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1
                    }
                } ]
            }).on("init", function(e, slick) {
                console.log(slick);
            });
        });
        $(".logo-slick-carousel").slick({
            infinite: !0,
            slidesToShow: 5,
            slidesToScroll: 4,
            dots: !0,
            arrows: !0,
            responsive: [ {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            }, {
                breakpoint: 769,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            } ]
        });
        $(window).on("load resize", function(e) {
            var carouselListItems = $(".fullwidth-slick-carousel .fw-carousel-item").length;
            if (carouselListItems < 4) {
                $(".fullwidth-slick-carousel .slick-slide").css({
                    "pointer-events": "all",
                    opacity: "1"
                });
            }
        });
        $(window).on("load resize", function(e) {
            var carouselListItems = $(".listing-slider-small .slick-track").children().length;
            if (carouselListItems < 2) {
                $(".listing-slider-small .slick-track").css({
                    transform: "none"
                });
            }
        });
        (function($) {
            $.fn.numberPicker = function() {
                var dis = "disabled";
                return this.each(function() {
                    var picker = $(this), p = picker.find("button:last-child"), m = picker.find("button:first-child"), input = picker.find("input"), min = parseInt(input.attr("min"), 10), max = parseInt(input.attr("max"), 10), inputFunc = function(picker) {
                        var i = parseInt(input.val(), 10);
                        if (i <= min || !i) {
                            input.val(min);
                            p.prop(dis, !1);
                            m.prop(dis, !0);
                        } else if (i >= max) {
                            input.val(max);
                            p.prop(dis, !0);
                            m.prop(dis, !1);
                        } else {
                            p.prop(dis, !1);
                            m.prop(dis, !1);
                        }
                    }, changeFunc = function(picker, qty) {
                        var q = parseInt(qty, 10), i = parseInt(input.val(), 10);
                        if (i < max && q > 0 || i > min && !(q > 0)) {
                            input.val(i + q);
                            inputFunc(picker);
                        }
                    };
                    m.on("click", function(e) {
                        e.preventDefault();
                        changeFunc(picker, -1);
                    });
                    p.on("click", function(e) {
                        e.preventDefault();
                        changeFunc(picker, 1);
                    });
                    input.on("change", function() {
                        inputFunc(picker);
                    });
                    inputFunc(picker);
                });
            };
        })(jQuery);
        $(".plusminus").numberPicker();
        var $tabsNav = $(".tabs-nav"), $tabsNavLis = $tabsNav.children("li");
        $tabsNav.each(function() {
            var $this = $(this);
            $this.next().children(".tab-content").stop(!0, !0).hide().first().show();
            $this.children("li").first().addClass("active").stop(!0, !0).show();
        });
        $tabsNavLis.on("click", function(e) {
            var $this = $(this);
            $this.siblings().removeClass("active").end().addClass("active");
            $this.parent().next().children(".tab-content").stop(!0, !0).hide().siblings($this.find("a").attr("href")).fadeIn();
            e.preventDefault();
        });
        var hash = window.location.hash;
        var anchor = $('.tabs-nav a[href="' + hash + '"]');
        if (anchor.length === 0) {
            $(".tabs-nav li:first").addClass("active").show();
            $(".tab-content:first").show();
        } else {
            anchor.parent("li").click();
        }
        var $accor = $(".accordion");
        $accor.each(function() {
            $(this).toggleClass("ui-accordion ui-widget ui-helper-reset");
            $(this).find("h3").addClass("ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all");
            $(this).find("div").addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom");
            $(this).find("div").hide();
        });
        var $trigger = $accor.find("h3");
        $trigger.on("click", function(e) {
            var location = $(this).parent();
            if ($(this).next().is(":hidden")) {
                var $triggerloc = $("h3", location);
                $triggerloc.removeClass("ui-accordion-header-active ui-state-active ui-corner-top").next().slideUp(300);
                $triggerloc.find("span").removeClass("ui-accordion-icon-active");
                $(this).find("span").addClass("ui-accordion-icon-active");
                $(this).addClass("ui-accordion-header-active ui-state-active ui-corner-top").next().slideDown(300);
            }
            e.preventDefault();
        });
        $(".toggle-container").hide();
        $(".trigger, .trigger.opened").on("click", function(a) {
            $(this).toggleClass("active");
            a.preventDefault();
        });
        $(".trigger").on("click", function() {
            $(this).next(".toggle-container").slideToggle(300);
        });
        $(".trigger.opened").addClass("active").next(".toggle-container").show();
        $(".tooltip.top").tipTip({
            defaultPosition: "top"
        });
        $(".tooltip.bottom").tipTip({
            defaultPosition: "bottom"
        });
        $(".tooltip.left").tipTip({
            defaultPosition: "left"
        });
        $(".tooltip.right").tipTip({
            defaultPosition: "right"
        });
        $(".more-search-options-trigger").on("click", function(e) {
            e.preventDefault();
            $(".more-search-options, .more-search-options-trigger").toggleClass("active");
            $(".more-search-options.relative").animate({
                height: "toggle",
                opacity: "toggle"
            }, 300);
        });
        $(window).on("load resize", function() {
            var winWidth = $(window).width();
            var headerHeight = $("#header-container").height();
            $(".fs-inner-container, .fs-inner-container.map-fixed, #dashboard").css("padding-top", headerHeight);
            if (winWidth < 992) {
                $(".fs-inner-container.map-fixed").insertBefore(".fs-inner-container.content");
            } else {
                $(".fs-inner-container.content").insertBefore(".fs-inner-container.map-fixed");
            }
            if (winWidth <= 768) {
                $(".listing-nav-container > ul.listing-nav").addClass("more-search-options relative");
            } else {
                $(".listing-nav-container > ul.listing-nav").removeClass("more-search-options relative");
            }
        });
        $(window).on("load", function() {
            $(".listeo-dashoard-widgets .dashboard-stat-content h4").counterUp({
                delay: 100,
                time: 800,
                formatter: function(n) {
                    if ($("#waller-row").data("numberFormat") == "euro") {
                        return n.replace(".", ",");
                    } else {
                        return n;
                    }
                }
            });
        });
        $(".leave-rating input").change(function() {
            var $radio = $(this);
            $(".leave-rating .selected").removeClass("selected");
            $radio.closest("label").addClass("selected");
        });
        $(".dashboard-nav ul li a").on("click", function() {
            if ($(this).closest("li").has("ul").length) {
                $(this).parent("li").toggleClass("active");
            }
        });
        $(window).on("load resize", function() {
            var wrapperHeight = window.innerHeight;
            var headerHeight = $("#header-container").height();
            var winWidth = $(window).width();
            if (winWidth > 992) {
                $(".dashboard-nav-inner").css("max-height", wrapperHeight - headerHeight);
            } else {
                $(".dashboard-nav-inner").css("max-height", "");
            }
        });
        $(".tip").each(function() {
            var tipContent = $(this).attr("data-tip-content");
            $(this).append('<div class="tip-content">' + tipContent + "</div>");
        });
        $(".verified-badge.with-tip").each(function() {
            var tipContent = $(this).attr("data-tip-content");
            $(this).append('<div class="tip-content">' + tipContent + "</div>");
        });
        $(window).on("load resize", function() {
            var verifiedBadge = $(".verified-badge.with-tip");
            verifiedBadge.find(".tip-content").css({
                width: verifiedBadge.outerWidth(),
                "max-width": verifiedBadge.outerWidth()
            });
        });
        $(".dashboard-responsive-nav-trigger").on("click", function(e) {
            e.preventDefault();
            $(this).toggleClass("active");
            var dashboardNavContainer = $("body").find(".dashboard-nav");
            if ($(this).hasClass("active")) {
                $(dashboardNavContainer).addClass("active");
            } else {
                $(dashboardNavContainer).removeClass("active");
            }
        });
        $(window).on("load resize", function() {
            var msgContentHeight = $(".message-content").outerHeight();
            var msgInboxHeight = $(".messages-inbox ul").height();
            if (msgContentHeight > msgInboxHeight) {
                $(".messages-container-inner .messages-inbox ul").css("max-height", msgContentHeight);
            }
        });
        $("a.close").removeAttr("href").on("click", function() {
            function slideFade(elem) {
                var fadeOut = {
                    opacity: 0,
                    transition: "opacity 0.5s"
                };
                elem.css(fadeOut).slideUp();
            }
            slideFade($(this).parent());
        });
        function close_panel_dropdown() {
            $(".panel-dropdown").removeClass("active");
            $(".fs-inner-container.content").removeClass("faded-out");
        }
        $(".panel-dropdown a").on("click", function(e) {
            if ($(this).parent().is(".active")) {
                close_panel_dropdown();
            } else {
                close_panel_dropdown();
                $(this).parent().addClass("active");
                $(".fs-inner-container.content").addClass("faded-out");
            }
            e.preventDefault();
        });
        $(".panel-buttons button,.panel-buttons span.panel-cancel").on("click", function(e) {
            $(".panel-dropdown").removeClass("active");
            $(".fs-inner-container.content").removeClass("faded-out");
        });
        var $inputRange = $('input[type="range"].distance-radius');
        $inputRange.rangeslider({
            polyfill: !1,
            onInit: function() {
                var radiustext = $(".distance-radius").attr("data-title");
                this.output = $('<div class="range-output" />').insertBefore(this.$range).html(this.$element.val()).after('<i class="data-radius-title">' + radiustext + "</i>");
            },
            onSlide: function(position, value) {
                this.output.html(value);
            }
        });
        $(".sidebar .panel-disable").on("click", function(e) {
            var to = $(".sidebar .range-slider");
            var enable = $(this).data("enable");
            var disable = $(this).data("disable");
            to.toggleClass("disabled");
            if (to.hasClass("disabled")) {
                $(to).find("input").prop("disabled", !0);
                $(this).html(enable);
            } else {
                $(to).find("input").prop("disabled", !1);
                $(this).html(disable);
            }
            $inputRange.rangeslider("update");
        });
        if (listeo_core.radius_state == "disabled") {
            $(".sidebar .panel-disable").each(function(index) {
                var enable = $(this).data("enable");
                $(".sidebar .range-slider").toggleClass("disabled").find("input").prop("disabled", !0);
                $inputRange.rangeslider("update");
                $(this).html(enable);
            });
            $(".panel-buttons span.panel-disable").each(function(index) {
                var to = $(this).parent().parent();
                var enable = $(this).data("enable");
                var disable = $(this).data("disable");
                to.toggleClass("disabled");
                if (to.hasClass("disabled")) {
                    $(to).find("input").prop("disabled", !0);
                    $(this).html(enable);
                } else {
                    $(to).find("input").prop("disabled", !1);
                    $(this).html(disable);
                }
                $inputRange.rangeslider("update");
            });
        }
        $(".panel-buttons span.panel-disable").on("click", function(e) {
            var to = $(this).parent().parent();
            var enable = $(this).data("enable");
            var disable = $(this).data("disable");
            to.toggleClass("disabled");
            if (to.hasClass("disabled")) {
                $(to).find("input").prop("disabled", !0);
                $(this).html(enable);
            } else {
                $(to).find("input").prop("disabled", !1);
                $(this).html(disable);
            }
            $inputRange.rangeslider("update");
        });
        var mouse_is_inside = !1;
        $(".panel-dropdown").hover(function() {
            mouse_is_inside = !0;
        }, function() {
            mouse_is_inside = !1;
        });
        $("body").mouseup(function() {
            if (!mouse_is_inside) close_panel_dropdown();
        });
        $(".checkboxes.categories input").on("change", function() {
            if ($(this).hasClass("all")) {
                $(this).parents(".checkboxes").find("input").prop("checked", !1);
                $(this).prop("checked", !0);
            } else {
                $(".checkboxes input.all").prop("checked", !1);
            }
        });
        function ThousandSeparator(nStr) {
            nStr += "";
            var x = nStr.split(".");
            var x1 = x[0];
            var x2 = x.length > 1 ? "." + x[1] : "";
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, "$1" + "," + "$2");
            }
            return x1 + x2;
        }
        var currencyAttr = $(".bootstrap-range-slider").attr("data-slider-currency");
        $(".bootstrap-range-slider").slider({
            formatter: function(value) {
                if (listeo_core.currency_position == "before") {
                    return currencyAttr + " " + ThousandSeparator(parseFloat(value[0])) + " - " + ThousandSeparator(parseFloat(value[1]));
                } else {
                    return ThousandSeparator(parseFloat(value[0])) + " - " + ThousandSeparator(parseFloat(value[1])) + " " + currencyAttr;
                }
            }
        });
        if (!$(".range-slider-container").hasClass("no-to-disable")) {
            $(".bootstrap-range-slider").slider("disable").prop("disabled", !0).toggleClass("disabled");
        } else {
            var dis = $(".slider-disable").data("disable");
            $(".slider-disable").html(dis);
        }
        $('.range-slider-container:not(".no-to-disable")').toggleClass("disabled");
        $(".slider-disable").click(function() {
            var to = $(".range-slider-container");
            var enable = $(this).data("enable");
            var disable = $(this).data("disable");
            to.toggleClass("disabled");
            if (to.hasClass("disabled")) {
                $(".bootstrap-range-slider").slider("disable");
                $(to).find("input").prop("disabled", !0);
                $(this).html(enable);
            } else {
                $(".bootstrap-range-slider").slider("enable");
                $(to).find("input").prop("disabled", !1);
                $(this).html(disable);
            }
        });
        $(".show-more-button").on("click", function(e) {
            e.preventDefault();
            $(this).toggleClass("active");
            $(".show-more").toggleClass("visible");
            if ($(".show-more").is(".visible")) {
                var el = $(".show-more"), curHeight = el.height(), autoHeight = el.css("height", "auto").height();
                el.height(curHeight).animate({
                    height: autoHeight
                }, 400);
            } else {
                $(".show-more").animate({
                    height: "450px"
                }, 400);
            }
        });
        if (document.getElementById("listing-nav") !== null) {
            $(window).scroll(function() {
                var window_top = $(window).scrollTop();
                var div_top = $("._listing-nav").not("._listing-nav-container.cloned ._listing-nav").offset().top + 90;
                if (window_top > div_top) {
                    $("._listing-nav-container.cloned").addClass("stick");
                } else {
                    $("._listing-nav-container.cloned").removeClass("stick");
                }
            });
        }
        $("._listing-nav-container").clone(!0).addClass("cloned").prependTo("body");
        $("._listing-nav a, a.listing-address, .star-rating a").on("click", function(e) {
            e.preventDefault();
            $("html,body").scrollTo(this.hash, this.hash, {
                gap: {
                    y: -20
                }
            });
        });
        $("._listing-nav li:first-child a, a.add-review-btn, a[href='#add-review']").on("click", function(e) {
            e.preventDefault();
            $("html,body").scrollTo(this.hash, this.hash, {
                gap: {
                    y: -100
                }
            });
        });
        $(window).on("load resize", function() {
            var aChildren = $("._listing-nav li").children();
            var aArray = [];
            for (var i = 0; i < aChildren.length; i++) {
                var aChild = aChildren[i];
                var ahref = $(aChild).attr("href");
                aArray.push(ahref);
            }
            $(window).scroll(function() {
                var windowPos = $(window).scrollTop();
                for (var i = 0; i < aArray.length; i++) {
                    var theID = aArray[i];
                    if ($(theID).length > 0) {
                        var divPos = $(theID).offset().top - 150;
                        var divHeight = $(theID).height();
                        if (windowPos >= divPos && windowPos < divPos + divHeight) {
                            $("a[href='" + theID + "']").addClass("active");
                        } else {
                            $("a[href='" + theID + "']").removeClass("active");
                        }
                    }
                }
            });
        });
        var time24 = !1;
        if (listeo_core.clockformat) {
            time24 = !0;
        }
        $(".listeo-flatpickr").flatpickr({
            enableTime: !0,
            noCalendar: !0,
            dateFormat: "H:i",
            time_24hr: time24,
            disableMobile: !0
        });
        $(".day_hours_reset").on("click", function(e) {
            $(this).parent().parent().find("input").val("");
        });
        var radios = document.querySelectorAll(".payment-tab-trigger > input");
        for (var i = 0; i < radios.length; i++) {
            radios[i].addEventListener("change", expandAccordion);
        }
        function expandAccordion(event) {
            var allTabs = document.querySelectorAll(".payment-tab");
            for (var i = 0; i < allTabs.length; i++) {
                allTabs[i].classList.remove("payment-tab-active");
            }
            event.target.parentNode.parentNode.classList.add("payment-tab-active");
        }
        function ratingOverview(ratingElem) {
            $(ratingElem).each(function() {
                var dataRating = $(this).attr("data-rating");
                if (dataRating >= 4) {
                    $(this).addClass("high");
                    $(this).find(".rating-bars-rating-inner").css({
                        width: dataRating / 5 * 100 + "%"
                    });
                } else if (dataRating >= 3) {
                    $(this).addClass("mid");
                    $(this).find(".rating-bars-rating-inner").css({
                        width: dataRating / 5 * 80 + "%"
                    });
                } else if (dataRating < 3) {
                    $(this).addClass("low");
                    $(this).find(".rating-bars-rating-inner").css({
                        width: dataRating / 5 * 60 + "%"
                    });
                }
            });
        }
        ratingOverview(".rating-bars-rating");
        $(window).on("resize", function() {
            ratingOverview(".rating-bars-rating");
        });
        $(".message-vendor").on("click", function() {
            $(".captcha-holder").addClass("visible");
        });
        if (listeo_core.map_provider == "google") {
            $(".show-map-button").on("click", function(event) {
                event.preventDefault();
                $(".hide-map-on-mobile").toggleClass("map-active");
                var text_enabled = $(this).data("enabled");
                var text_disabled = $(this).data("disabled");
                if ($(".hide-map-on-mobile").hasClass("map-active")) {
                    $(this).text(text_disabled);
                } else {
                    $(this).text(text_enabled);
                }
            });
        }
        $(window).on("load resize", function() {
            $(".fs-inner-container.map-fixed").addClass("hide-map-on-mobile");
            $("#map-container").addClass("hide-map-on-mobile");
        });
        $(".numerical-rating").numericalRating();
        $(".star-rating").starRating();
    });
})(this.jQuery);
