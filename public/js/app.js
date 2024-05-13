$(document).ready(function () {

	// responsive nav
	var responsiveNav = $('#toggle-nav');
	var navBar = $('.nav-bar');

	responsiveNav.on('click', function (e) {
		e.preventDefault();
		console.log(navBar);
		navBar.toggleClass('active')
	});

	// pseudo active
	if ($('#docs').length) {
		var sidenav = $('ul.side-nav').find('a');
		var url = window.location.pathname.split('/');
		var url = url[url.length - 1];

		sidenav.each(function (i, e) {
			var active = $(e).attr('href');

			if (active === url) {
				$(e).parent('li').addClass('active');
				return false;
			}
		});
	}

});
$(document).ready(function () {
	$(".image-slider").slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		infinite: true,
		arrows: true,
		draggable: true,
		prevArrow: `<button type='button' class='slick-prev slick-arrow'><i class="fa-solid fa-arrow-left"></i></button>`,
		nextArrow: `<button type='button' class='slick-next slick-arrow'><i class="fa-solid fa-arrow-right"></i></button>`,
		dots: false,
		responsive: [
			{
				breakpoint: 1025,
				settings: {
					slidesToShow: 3,
				},
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					arrows: false,
					infinite: false,
				},
			},
		],
		// autoplay: true,
		// autoplaySpeed: 1000,
	});
});


