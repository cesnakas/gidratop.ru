
(function() {
	'use strict';

	if (!!window.JCCatalogProductsViewedComponent)
		return;

	window.JCCatalogProductsViewedComponent = function(params) {
		this.container = document.querySelector('[data-entity="' + params.container + '"]');

		if (params.initiallyShowHeader)
		{
			BX.ready(BX.delegate(this.showHeader, this));
		}
	};

	window.JCCatalogProductsViewedComponent.prototype =
	{
		showHeader: function(animate)
		{
			var parentNode = BX.findParent(this.container, {attr: {'data-entity': 'parent-container'}}),
				header;

			if (parentNode && BX.type.isDomNode(parentNode))
			{
				header = parentNode.querySelector('[data-entity="header"');

				if (header && header.getAttribute('data-showed') != 'true')
				{
					header.style.display = '';

					if (animate)
					{
						new BX.easing({
							duration: 2000,
							start: {opacity: 0},
							finish: {opacity: 100},
							transition: BX.easing.makeEaseOut(BX.easing.transitions.quad),
							step: function(state){
								header.style.opacity = state.opacity / 100;
							},
							complete: function(){
								header.removeAttribute('style');
								header.setAttribute('data-showed', 'true');
							}
						}).animate();
					}
					else
					{
						header.style.opacity = 100;
					}
				}
			}
		}
	}
})();

$(document).ready(function() {

    $(".section_carusel_recomend").owlCarousel({
        items: 5,
        nav: true,
		navSpeed: 1000,
        dots: false,
        margin: 15,
        responsiveClass: true,
        responsive:{
            0:{
                items: 1,
                margin: 0
            },
            415: {
                items: 2,
                margin: 5
            },
            481: {
                items: 3,
                margin: 5
            },
            641: {
                items: 4,
                margin: 10
            },
            769: {
                items: 6,
                margin: 7
            },
            1025:{
                items:5,
                nav:true
            }
        }
    });
});