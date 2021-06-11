function rotateCard(btn) {
  var $card = $(btn).closest('.card-container');
  console.log($card);
  if ($card.hasClass('hover')) {
    $card.removeClass('hover');
  } else {
    $card.addClass('hover');
  }
}
$(document).ready(function () {
  var table = $('#example').DataTable({
    rowReorder: {
      selector: 'td:nth-child(2)'
    },
    responsive: true
  });
});
jQuery(document).ready(function ($) {
  $("#owl-demo").owlCarousel({
    navigation: true,
    smartSpeed: 500,
    dots: false,
    items: 1,
    loop: true,
    singleItem: true,
    autoplay: true,
  });
});
jQuery(document).ready(function ($) {
  $("#owl-demo2").owlCarousel({
    navigation: true,
    rtl: true,
    margin: 100,
    dots: false,
    smartSpeed: 500,
    items: 1,
    loop: true,
    singleItem: true,
    autoplay: true,
  });
});
jQuery(document).ready(function ($) {
  $("#owl-demo3").owlCarousel({
    items: 1,
    loop: true,
    margin: 30,
    dots: false,
    autoplayHoverPause: true,
    smartSpeed: 500,
    autoplay: true,
  });
});
jQuery(document).ready(function ($) {
  $("#owl-demo4").owlCarousel({
    items: 1,
    loop: true,
    margin: true,
    video: true,
    autoplayHoverPause: true,
    smartSpeed: 500,
    autoplay: false,
  });
});


(function ($) {
  "use strict";


  var window_width = $(window).width(),
    window_height = window.innerHeight,
    header_height = $(".default-header").height(),
    header_height_static = $(".site-header.static").outerHeight(),
    fitscreen = window_height - header_height;

  $(".fullscreen").css("height", window_height)
  $(".fitscreen").css("height", fitscreen);


  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 600) {
      $('.scroll-top').fadeIn(600);
    } else {
      $('.scroll-top').fadeOut(600);
    }
  });
  $('.scroll-top').on("click", function () {
    $("html,body").animate({
      scrollTop: 0
    }, 500);
    return false;
  });


  // ------------------------------------------------------------------------------ //
  // Preloader 
  // ------------------------------------------------------------------------------ //

  $(document).ready(function () {
    setTimeout(function () {
      $('body').addClass('loaded');
    }, 1000);

  });


  // ------------------------------------------------------------------------------ //
  // Active Menu 
  // ------------------------------------------------------------------------------ //


  $('#dopeNav').dopeNav({
    stickyNav: true,
  });

  //Smooth Scrolling Using Navigation Menu
  $('a[href*="#banner-section"]').on('click', function (e) {
    $('html,body').animate({
      scrollTop: $($(this).attr('href')).offset().top - 70
    }, 500);
    e.preventDefault();
  });



  // ------------------------------------------------------------------------------ //
  // Team carousel  
  // ------------------------------------------------------------------------------ //


  $("#team-carusel").owlCarousel({
    items: 4,
    loop: true,
    margin: 30,
    dots: true,
    autoplayHoverPause: true,
    smartSpeed: 500,
    autoplay: false,
    responsive: {
      0: {
        items: 1
      },
      767: {
        items: 2
      },
      992: {
        items: 4
      }
    }
  });


  // ------------------------------------------------------------------------------ //
  // Service carousel  
  // ------------------------------------------------------------------------------ //


  $("#service-carusel").owlCarousel({
    items: 4,
    loop: true,
    margin: 15,
    dots: false,
    autoplayHoverPause: true,
    smartSpeed: 500,
    autoplay: true,
    nav: true,
    center: true,
    navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
    responsive: {
      0: {
        items: 1
      },
      767: {
        items: 2
      },
      992: {
        items: 4
      }
    }
  });


  // ------------------------------------------------------------------------------ //
  // Testimonial carousel  
  // ------------------------------------------------------------------------------ //


  $("#testimonial-carusel").owlCarousel({
    items: 2,
    loop: true,
    margin: 30,
    dots: true,
    autoplayHoverPause: true,
    smartSpeed: 500,
    autoplay: true,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 2
      }
    }
  });
  $("#testimonial-carusel4").owlCarousel({
    items: 3,
    loop: true,
    dots: true,
    autoplayHoverPause: true,
    smartSpeed: 500,
    autoplay: true,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 2
      }
    }
  });
  $("#testimonial3-carusel").owlCarousel({
    items: 1,
    loop: true,
    margin: 30,
    dots: true,
    autoplayHoverPause: true,
    smartSpeed: 500,
    autoplay: true,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 2
      }
    }
  });


  $("#testimonial-carusel2").owlCarousel({
    items: 1,
    loop: true,
    margin: 30,
    dots: true,
    autoplayHoverPause: true,
    smartSpeed: 500,
    autoplay: true,
  });


  // ------------------------------------------------------------------------------ //
  // Screenshot carousel  
  // ------------------------------------------------------------------------------ //


  $('#screenshot-carusel').owlCarousel({
    loop: true,
    responsiveClass: true,
    nav: true,
    margin: 5,
    autoplayTimeout: 4000,
    smartSpeed: 500,
    center: true,
    navText: ['<span class="ti ti-angle-left"></span>', '<span class="ti ti-angle-right"></span>'],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3
      },
      1200: {
        items: 5
      }
    }
  });






  // ------------------------------------------------------------------------------ //
  // Stat Counter  
  // ------------------------------------------------------------------------------ //

  $('.counter').counterUp({
    delay: 10,
    time: 1000
  });


  // ------------------------------------------------------------------------------ //
  // Skill Section  
  // ------------------------------------------------------------------------------ //


  $(document).ready(function () {

    $(".skills").addClass("active");
    $(".skills .skill .skill-bar span").each(function () {
      $(this).animate({
        "width": $(this).parent().attr("data-bar") + "%"
      }, 1000);
      $(this).append('<b>' + $(this).parent().attr("data-bar") + '%</b>');
    });
    setTimeout(function () {
      $(".skills .skill .skill-bar span b").animate({
        "opacity": "1"
      }, 1000);
    }, 2000);
  });

  // ------------------------------------------------------------------------------ //
  // Accordian   
  // ------------------------------------------------------------------------------ //


  var allPanels = $(".accordion > dd").hide();
  allPanels.first().slideDown("easeOutExpo");
  $(".accordion").each(function () {
    $(this).find("dt > a").first().addClass("active").parent().next().css({
      display: "block"
    });
  });

  $(document).on('click', '.accordion > dt > a', function (e) {
    var current = $(this).parent().next("dd");
    $(this).parents(".accordion").find("dt > a").removeClass("active");
    $(this).addClass("active");
    $(this).parents(".accordion").find("dd").slideUp("easeInExpo");
    $(this).parent().next().slideDown("easeOutExpo");
    return false;

  });


  // ------------------------------------------------------------------------------ //
  // Skillbar
  // ------------------------------------------------------------------------------ //


  $(".skill_main").each(function () {
    $(this).waypoint(function () {
      var progressBar = $(".progress-bar");
      progressBar.each(function (indx) {
        $(this).css("width", $(this).attr("aria-valuenow") + "%")
      })
    }, {
      triggerOnce: true,
      offset: 'bottom-in-view'

    });
  });




  // ------------------------------------------------------------------------------ //
  // Parallux Background 
  // ------------------------------------------------------------------------------ //

  $(window).stellar();

  // ------------------------------------------------------------------------------ //
  // Rabeg Form  
  // ------------------------------------------------------------------------------ //

  $(document).ready(function () {
    $('#username').blur(function () {
      var username = $(this).val();
      $.ajax({
        url: "rabeg/check_user.php",
        method: "POST",
        data: {
          user_name: username
        },
        dataType: "text",
        success: function (data) {
          if (data == 1) {
            $('#user_verifed').html('<span class="badge badge-pill badge-success">Username terverifikasi</span>');
          } else {
            $('#user_verifed').html('<span class="badge badge-pill badge-danger">Username tidak ada. Mohon cek kembali.!</span>');
          }
        }
      })
    });
  });

  $(document).ready(function () {
    $('#pass').blur(function () {
      var name = $("#username").val();
      var password = $("#pass").val();
      $.ajax({
        url: "rabeg/check_pass.php",
        method: "POST",
        data: {
          user_name: name,
          pass_word: password
        },
        dataType: "text",
        success: function (data) {
          if (name == "") {
            $('#pass_verifed').html('<span class="badge badge-pill badge-danger">Mohon isi username dahulu</span>');
          } else if (password == "") {
            $('#pass_verifed').html('<span class="badge badge-pill badge-danger">Password tidak boleh kosong</span>');
          } else if (data == 1) {
            $('#pass_verifed').html('<span class="badge badge-pill badge-success">Password benar</span>');
            $('#posting').attr("disabled", false);
            $('#username').attr("disabled", true);
            $('#pass').attr("disabled", true);
            $('#judul').attr("disabled", false);
            $('#isi').attr("disabled", false);
            $('#kategori').attr("disabled", false);
            $('#alamat').attr("disabled", false);
          } else {
            $('#pass_verifed').html('<span class="badge badge-pill badge-danger">Password salah. Mohon cek kembali.!</span>');
          }
        }
      })
    });
  });

  $(document).ready(function () {
    $('#judul').blur(function () {
      var judul = $("#judul").val();
      if (judul != '') {
        if (/^\w[\w\s]+$/.test(judul)) {
          $('#judul_verifed').html('<span class="badge badge-pill badge-success">Inputan benar</span>');
        } else {
          $('#judul_verifed').html('<span class="badge badge-pill badge-danger">Inputan hanya boleh huruf dan angka</span>');
        }
      } else {
        $('#judul_verifed').html('<span class="badge badge-pill badge-danger">Inputan tidak boleh kosong</span>');
      }
    });
  });

  $(document).ready(function () {
    $('#isi').blur(function () {
      var isi = $("#isi").val();
      if (isi != '') {
        if (/^\w[\w\s]+$/.test(isi)) {
          $('#isi_verifed').html('<span class="badge badge-pill badge-success">Inputan benar</span>');
        } else {
          $('#isi_verifed').html('<span class="badge badge-pill badge-danger">Inputan hanya boleh huruf, angka dan spasi</span>');
        }
      } else {
        $('#isi_verifed').html('<span class="badge badge-pill badge-danger">Inputan tidak boleh kosong</span>');
      }
    });
  });

  $(document).ready(function () {
    $('#kategori').blur(function () {
      var kategori = $("#kategori").val();
      if (kategori != '') {
        $('#kategori_verifed').html('<span class="badge badge-pill badge-success">Inputan benar</span>');
      } else {
        $('#kategori_verifed').html('<span class="badge badge-pill badge-danger">Pilih salah satu</span>');
      }
    });
  });

  $(document).ready(function () {
    $('#alamat').blur(function () {
      var alamat = $("#alamat").val();
      if (alamat != '') {
        if (/^\w[\w\s]+$/.test(alamat)) {
          $('#alamat_verifed').html('<span class="badge badge-pill badge-success">Inputan benar</span>');
        } else {
          $('#alamat_verifed').html('<span class="badge badge-pill badge-danger">Inputan hanya boleh huruf, angka dan spasi</span>');
        }
      } else {
        $('#alamat_verifed').html('<span class="badge badge-pill badge-danger">Inputan tidak boleh kosong</span>');
      }
    });
  });

  $('#posting').click(function () {
    var name = $("#username").val();
    var judul = $("#judul").val();
    var isi = document.getElementById('isi').value;
    var kategori = document.getElementById('kategori').value;
    var alamat = $("#alamat").val();
    $.ajax({
      url: "rabeg/check_post.php",
      method: "POST",
      data: {
        user_name: name,
        post_judul: judul,
        post_isi: isi,
        post_kategori: kategori,
        post_alamat: alamat
      },
      dataType: "text",
      success: function (response) {
        alert(response);
        window.location.reload();
      }
    })
  });

  // ------------------------------------------------------------------------------ //
  // Contact Form  
  // ------------------------------------------------------------------------------ //

  var submitContact = $('#submit-message'),
    message = $('#msg');

  submitContact.on('click', function (e) {
    e.preventDefault();

    var $this = $(this);

    $.ajax({
      type: "POST",
      url: 'contact.php',
      dataType: 'json',
      cache: false,
      data: $('#contact-form').serialize(),
      success: function (data) {

        if (data.info !== 'error') {
          $this.parents('form').find('input[type=text],input[type=email],textarea,select').filter(':visible').val('');
          message.hide().removeClass('success').removeClass('error').addClass('success').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
        } else {
          message.hide().removeClass('success').removeClass('error').addClass('error').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
        }
      }
    });
  });

})(jQuery);