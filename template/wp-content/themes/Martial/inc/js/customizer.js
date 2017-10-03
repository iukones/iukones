/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
  // site title
  wp.customize('blogname', function (value) {
    value.bind(function (to) {
      $('#site-title').text(to);
    });
  });

  // tagline
  wp.customize('blogdescription', function (value) {
    value.bind(function (to) {
      $('#tagline').text(to);
    });
  });
  // header logo
  wp.customize('martial_header_logo_show', function (value) {
    value.bind(function (to) {
      if (to === 'text') {
        $('.header_in .logo .header-logo').show();
        $('.header_in .logo img').hide();
      }

      if (to === 'logo') {
        $('.header_in .logo .header-logo').hide();
        $('.header_in .logo img').show();
      }
    });
  });

  // martial header logo image
  wp.customize('martial_header_logo_image', function (value) {
    value.bind(function (to) {
      $('.header_in .logo img').attr('src', to);
    });
  });

  // martial hero banner
  wp.customize('martial_hero_show', function (value) {
    value.bind(function (to) {
      return to === 'yes' ? $('.banner').show() : $('.banner').hide();
    });
  });

  // martial hero banner bg image
  wp.customize('martial_hero_bg_image', function (value) {
    value.bind(function (to) {
      $('.banner-bg').attr('style', 'background-image: url(' + to + ')');
    });
  });

  // martial hero banner title
  wp.customize('martial_hero_title', function (value) {
    value.bind(function (to) {
      $('.banner .banner_left h1').text(to);
    });
  });

  // martial hero banner text
  wp.customize('martial_hero_text', function (value) {
    value.bind(function (to) {
      $('.banner .banner_left .text').html(to);
    });
  });

  // martial hero button 1 show/hide
  wp.customize('martial_hero_button1_show', function (value) {
    value.bind(function (to) {
      return to === 'yes' ? $('.banner .text .about:not(.contact)').show() : $('.banner .text .about:not(.contact)').hide();
    });
  });

  // martial hero button 1 text
  wp.customize('martial_hero_button1_text', function (value) {
    value.bind(function (to) {
      $('.banner .text .about:not(.contact)').text(to);
    });
  });

  // martial hero button 1 link
  wp.customize('martial_hero_button1_link', function (value) {
    value.bind(function (to) {
      $('.banner .text .about:not(.contact)').attr('href', encodeURI(to));
    });
  });

  // martial hero button 1 bg color
  wp.customize('martial_hero_button1_bg_color', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('.banner .text .about:not(.contact)').css({'background-color': undefined});
      }
      $('.banner .text .about:not(.contact)').css({'background-color': to});
    });
  });

  // martial hero button 1 color
  wp.customize('martial_hero_button1_text_color', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('.banner .text .about:not(.contact)').css({color: undefined});
      }
      $('.banner .text .about:not(.contact)').css({'color': to});
    });
  });

  // martial hero button 2 show/hide
  wp.customize('martial_hero_button2_show', function (value) {
    value.bind(function (to) {
      return to === 'yes' ? $('.banner .text .contact').show() : $('.banner .text .contact').hide();
    });
  });

  // martial hero button 2 text
  wp.customize('martial_hero_button2_text', function (value) {
    value.bind(function (to) {
      $('.banner .text .contact').text(to);
    });
  });

  // martial hero button 2 link
  wp.customize('martial_hero_button2_link', function (value) {
    value.bind(function (to) {
      $('.banner .text .contact').attr('href', encodeURI(to));
    });
  });

  // martial hero button 2 bg color
  wp.customize('martial_hero_button2_bg_color', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('.banner .text .contact').css({'background-color': undefined});
      }
      $('.banner .text .contact').css({'background-color': to});
    });
  });

  // martial hero button 2 color
  wp.customize('martial_hero_button2_text_color', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('.banner .text .contact').css({color: undefined});
      }
      $('.banner .text .contact').css({'color': to});
    });
  });

  //martial hero overlay
  wp.customize('martial_hero_overlay_enabled', function (value) {
    value.bind(function (to) {
      $('.banner-bg-overlay').hide();
      if (to === 'yes') {
        $('.banner-bg-overlay').show();
      }
    });
  });

  //martial hero overlay color
  wp.customize('martial_hero_overlay_color', function (value) {
    value.bind(function (to) {
      if (to !== 'blank') {
        $('.banner-bg-overlay').css({'background-color': to});
      } else {
        $('.banner-bg-overlay').css({'background-color': undefined});
      }
    });
  });

  //martial hero overlay opacity
  wp.customize('martial_hero_overlay_opacity', function (value) {
    value.bind(function (to) {
      if (to !== 'blank') {
        $('.banner-bg-overlay').css({'opacity': to / 100});
      } else {
        $('.banner-bg-overlay').css({'opacity': undefined});
      }
    });
  });

  // martial hero social show/hide
  wp.customize('martial_header_social_show', function (value) {
    value.bind(function (to) {
      return to === 'yes' ? $('.banner ul').show() : $('.banner ul').hide();
    });
  });

  // martial hero social facebook
  wp.customize('martial_header_social_facebook', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .facebook').show() : $('.banner ul .facebook').hide();
    });
  });

  // martial hero social twitter
  wp.customize('martial_header_social_twitter', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .twitter').show() : $('.banner ul .twitter').hide();
    });
  });

  // martial hero social pinterest
  wp.customize('martial_header_social_pinterest', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .pinterest').show() : $('.banner ul .pinterest').hide();
    });
  });

  // martial hero social linkedin
  wp.customize('martial_header_social_linkedin', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .linkedin').show() : $('.banner ul .linkedin').hide();
    });
  });

  // martial hero social gplus
  wp.customize('martial_header_social_linkedin', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .gplus').show() : $('.banner ul .gplus').hide();
    });
  });

  // martial hero social behance
  wp.customize('martial_header_social_behance', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .behance').show() : $('.banner ul .behance').hide();
    });
  });

  // martial hero social dribbble
  wp.customize('martial_header_social_dribbble', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .dribbble').show() : $('.banner ul .dribbble').hide();
    });
  });

  // martial hero social flickr
  wp.customize('martial_header_social_flickr', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .flickr').show() : $('.banner ul .flickr').hide();
    });
  });

  // martial hero social 500px
  wp.customize('martial_header_social_500px', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .social500px').show() : $('.banner ul .social500px').hide();
    });
  });

  // martial hero social reddit
  wp.customize('martial_header_social_reddit', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .reddit').show() : $('.banner ul .reddit').hide();
    });
  });

  // martial hero social wordpress
  wp.customize('martial_header_social_wordpress', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .wordpress').show() : $('.banner ul .wordpress').hide();
    });
  });

  // martial hero social youtube
  wp.customize('martial_header_social_youtube', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .youtube').show() : $('.banner ul .youtube').hide();
    });
  });

  // martial hero social youtube
  wp.customize('martial_header_social_soundcloud', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .soundcloud').show() : $('.banner ul .soundcloud').hide();
    });
  });

  // martial hero social youtube
  wp.customize('martial_header_social_medium', function (value) {
    value.bind(function (to) {
      return to.length > 0 ? $('.banner ul .medium').show() : $('.banner ul .medium').hide();
    });
  });

  // martial hero blur
  wp.customize('martial_hero_blur_enabled', function (value) {
    value.bind(function (to) {
      $('.banner-bg').css({'filter': 'blur(' + to + 'px)', '-webkit-filter': 'blur(' + to + 'px)'});
    });
  });


  // martial footer logo show/hide
  wp.customize('martial_footer_logo_show', function (value) {
    value.bind(function (to) {
      return to === 'yes' ? $('.footer_logo > a').show() : $('.footer_logo > a').hide();
    });
  });

  // martial footer logo image
  wp.customize('martial_footer_logo_image', function (value) {
    value.bind(function (to) {
      $('.footer_logo > a img.bottomlogo').attr('src', to);
    });
  });

  //martial_google_fonts_heading_font

  // Background color.
  wp.customize('background_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('body').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('body').css({
          'clip': 'auto',
          'background-color': to,
          'position': 'relative'
        });
      }
    });
  });

  // google fonts
  wp.customize('martial_google_fonts_body_font', function (value) {
    value.bind(function (to) {
      var font = to.replace(' ', '+');
      WebFontConfig = {
        google: { families: [ font + '::latin' ] }
      };
      (function () {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();

      // style the text
      if (to == 'none') {
        $('body').attr('style', '');
      }
      else {
        var myVar = setInterval(function () {
          if (typeof WebFont != 'undefined') {
            WebFont.load({
              google: {
                families: [font]
              }
            });
            clearInterval(myVar);
          }
        }, 100);

        $('body, p, span, small, input, li, li a, .block_cont_in :not(h1,h2,h3,h4,h5,.fa,h1 a, h2 a, h3 a, h4 a, h5 a), .banner_left .text a, .profile_cont :not(h1,h2,h3,h4,h5)').attr("style", 'font-family:"' + to + '" !important');
      }
    });
  });
  wp.customize('martial_google_fonts_heading_font', function (value) {
    value.bind(function (to) {
      var font = to.replace(' ', '+');
      WebFontConfig = {
        google: { families: [ font + '::latin' ] }
      };
      (function () {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();

      // style the text
      if (to == 'none') {
        $('h1,h2,h3,h4,h5,h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a').attr("style", '');
      }
      else {
        var myVar = setInterval(function () {
          if (typeof WebFont != 'undefined') {
            WebFont.load({
              google: {
                families: [font]
              }
            });
            clearInterval(myVar);
          }
        }, 100);

        $('h1,h2,h3,h4,h5,h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a').attr("style", 'font-family:"' + to + '" !important');
      }
    });
  });

  // colors
  wp.customize('martial_top_bar_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.wrapper header').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.wrapper header').css({
          'clip': 'auto',
          'background-color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_top_bar_text_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.wrapper header .header-logo').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.wrapper header .header-logo').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_top_bar_link_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.wrapper header .menu-item a').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.wrapper header .menu-item a').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_hero_bg_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.home .banner-bg').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.home .banner-bg').css({
          'clip': 'auto',
          'background-color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_hero_title_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.home .banner .banner_left h1').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.home .banner .banner_left h1').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_hero_text_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.home .banner .banner_left p').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.home .banner .banner_left p').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_hero_link_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.home .banner .banner_left ul li a .fa, .home .banner .banner_left .text a').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.home .banner .banner_left ul li a .fa, .home .banner .banner_left .text a').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_content_bg_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.block_cont, #sidebar > div, #comments, #responder').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.block_cont, #sidebar > div, #comments, #responder').css({
          'clip': 'auto',
          'background-color': to,
          'position': 'relative'
        });
      }
    })
  });

//  wp.customize('martial_content_text_color', function (value) {
//    value.bind(function (to) {
//      if ('blank' === to) {
//        $('.block_cont, #sidebar > div p, #comments p, #responder p, #sidebar .textwidget, .profile_cont h6 a').css({
//          'clip': 'rect(1px, 1px, 1px, 1px)',
//          'position': 'absolute'
//        });
//      } else {
//        $('.block_cont, #sidebar > div p, #comments p, #responder p, #sidebar .textwidget, .profile_cont h6 a').css({
//          'clip': 'auto',
//          'color': to,
//          'position': 'relative'
//        });
//      }
//    })
//  });

//  wp.customize('martial_content_link_color', function (value) {
//    value.bind(function (to) {
//      if ('blank' === to) {
//        $('#sidebar > div:not(.tab_sec) p a, #comments a, #responder a, #sidebar .textwidget a, .block_cont_in .content a:not(.read_more)').css({
//          'clip': 'rect(1px, 1px, 1px, 1px)',
//          'position': 'absolute'
//        });
//      } else {
//        $('#sidebar > div:not(.tab_sec) p a, #comments a, #responder a, #sidebar .textwidget a, .block_cont_in .content a:not(.read_more)').css({
//          'clip': 'auto',
//          'color': to,
//          'position': 'relative'
//        });
//      }
//    })
//  });

//  wp.customize('martial_content_heading_color', function (value) {
//    value.bind(function (to) {
//      if ('blank' === to) {
//        $('.main_content h1, .main_content h2, .main_content h3, .main_content h4, .main_content h5, .main_content h6, .main_content h1 a, .main_content h2 a, .main_content h3 a, .main_content h4 a, .main_content h5 a, .main_content h6 a').css({
//          'clip': 'rect(1px, 1px, 1px, 1px)',
//          'position': 'absolute'
//        });
//      } else {
//        $('.main_content h1, .main_content h2, .main_content h3, .main_content h4, .main_content h5, .main_content h6, .main_content h1 a, .main_content h2 a, .main_content h3 a, .main_content h4 a, .main_content h5 a, .main_content h6 a').css({
//          'clip': 'auto',
//          'color': to,
//          'position': 'relative'
//        });
//        $('.tabs_cont h6 a').attr('style', '');
//      }
//    })
//  });

  wp.customize('martial_content_bar_bg_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.postmeta ul').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.postmeta ul').css({
          'clip': 'auto',
          'background-color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_content_bar_text_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.postmeta ul li p, .postmeta ul li p a').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.postmeta ul li p, .postmeta ul li p a').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_content_border_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('#comments, #responder, .comments-title, .sidebarwidget, .tab_sec, .search_sec, .block_cont, .reply, #reply-title, #comment').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
        $('#sidebar .author ul').attr('style', '');
      } else {
        $('#comments, #responder, .comments-title, .sidebarwidget, .tab_sec, .search_sec, .block_cont, .reply, #reply-title, #comment').css({
          'clip': 'auto',
          'border-color': to,
          'position': 'relative'
        });
        $('#sidebar .author ul').css({
          'background-color': to
        });
      }
    })
  });

  wp.customize('martial_accent_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        // bg - .search input.submit, .tab_head li:hover, .tab_head li.active, .banner_left a.contact, .read_more, .pagination a, .pagination span
        $('.block_cont_in ul li .fa-folder-open-o, .block_cont_in ul li .fa-calendar-check-o, .block_cont_in ul li .fa-comments-o, .search input.submit, .tab_head li:hover, .tab_head li.active, .banner_left a.contact, .read_more, .pagination a, .pagination span, .profile_cont .fa').css({});
      } else {
        $('.block_cont_in ul li .fa-folder-open-o, .block_cont_in ul li .fa-calendar-check-o, .block_cont_in ul li .fa-comments-o, .profile_cont .fa').css({
          'color': to
        });
        $('.postmeta li a')
          .on('mouseenter', function (e) {
            $(e.target).attr('style', 'color: ' + to);
          })
          .on('mouseleave', function (e) {
            $(e.target).attr('style', '');
          });
        $('.tab_head li')
          .on('mouseenter', function (e) {
            var el = e.target;
            while(e.target.localName !== 'LI') {
              el = e.target.parentElement;
            }
            $(el).attr('style', 'background-color: ' + to);
          })
          .on('mouseleave', function (e) {
            $(e.target).attr('style', '');
          });
        $('.search input.submit, .tab_head li.active, .banner_left a.contact, .read_more, .pagination a, .pagination span').css({
          'background-color': to,
          'color': '#ffffff'
        });
      }
    })
  });

  wp.customize('martial_footer_bg_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('#footer').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('#footer').css({
          'clip': 'auto',
          'background-color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_footer_text_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('#footer, .footer_logo p').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('#footer, .footer_logo p').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_footer_link_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('#footer a, .footer_logo a').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('#footer a, .footer_logo a').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_footer_title_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.footer_blocks ul li h4').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.footer_blocks ul li h4').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_text_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('body .main_content, #responder, #comments, .author p, .profile_cont h6 a').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('body .main_content, #responder, #comments, .author p, .profile_cont h6 a').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_title_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.main_content h1, .main_content h2, .main_content h3, .main_content h4, .main_content h5, .block_cont_in h5, .main_content h1 a, .main_content h2 a, .main_content h3 a, .main_content h4 a, .main_content h5 a, .block_cont_in h5 a, .author h5, .sidebarwidget h5, .search_sec h5').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.main_content h1, .main_content h2, .main_content h3, .main_content h4, .main_content h5, .block_cont_in h5, .main_content h1 a, .main_content h2 a, .main_content h3 a, .main_content h4 a, .main_content h5 a, .block_cont_in h5 a, .author h5, .sidebarwidget h5, .search_sec h5').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  wp.customize('martial_link_color', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.content a:not(.read_more), #comments a, #respond a').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.content a:not(.read_more), #comments a, #respond a').css({
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        });
      }
    })
  });

  // end colors

})(jQuery);
