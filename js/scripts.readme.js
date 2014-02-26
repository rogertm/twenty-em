!function($){
	$(function(){
		var $window = $(window)
		var $body   = $(document.body)

		var navHeight = $('#docs-nav').outerHeight(true) + 10

		$body.scrollspy({
			target: '.docs-sidebar',
			offset: navHeight
		})
		
		$window.on('load', function () {
			$body.scrollspy('refresh')
		})

		$('.docs-sidebar').affix({
			offset: {
				top: function () {
					return (this.top = $('#docs-header').outerHeight(true))
				},
				bottom: 100
			}
		})
		

		// back to top
		setTimeout(function () {
		var $sideBar = $('.docs-sidebar')

		$sideBar.affix({
			offset: {
				top: function () {
					var offsetTop      = $sideBar.offset().top
					var sideBarMargin  = parseInt($sideBar.children(0).css('margin-top'), 10)
					var navOuterHeight = $('#docs-nav').height()

					return (this.top = offsetTop - navOuterHeight - sideBarMargin)
				},
				bottom: function () {
					return (this.bottom = $('#docs-footer').outerHeight(true))
				}
			}
		})
		}, 100)

		setTimeout(function () {
			$('.docs-sidebar').affix()
		}, 100)
	});
}(window.jQuery)
