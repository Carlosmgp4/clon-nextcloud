document.addEventListener('DOMContentLoaded', function() {
	var aboutEntry = document.querySelector('#expanddiv li[data-id="firstrunwizard_about"] a');
	if (aboutEntry) {
		aboutEntry.addEventListener('click', function (event) {
			event.stopPropagation();
			event.preventDefault();
			OCP.Loader.loadScript('firstrunwizard', 'firstrunwizard-main.js').then(function () {
				OCA.FirstRunWizard.open();
				OC.hideMenus(function () {
					return false;
				});
			});
			return true;
		});
	}
});
