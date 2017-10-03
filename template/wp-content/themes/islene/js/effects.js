jQuery(document).ready(function() {
  
  jQuery("#slider").owlCarousel({
      items : 3,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
	  navigation: true,
      navigationText: [
      "<i class='fa fa-angle-left' aria-hidden='true'></i>",
      "<i class='fa fa-angle-right' aria-hidden='true'></i>"
      ],
  });
  
});

jQuery(document).ready(function() {
  
  jQuery("#slider2").owlCarousel({
	  navigation: true,
	  singleItem:true,
      navigationText: [
      "<i class='fa fa-angle-left' aria-hidden='true'></i>",
      "<i class='fa fa-angle-right' aria-hidden='true'></i>"
      ],
  });
  
});