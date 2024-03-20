		function flashMessage(title, text, status) {
			new Notify({
				status: status,
				title: title,
				text: text,
				effect: 'slide',
				speed: 500,
				customClass: '',
				customIcon: '',
				showIcon: true,
				showCloseButton: true,
				autoclose: true,
				autotimeout: 5000,
				notificationsGap: null,
				notificationsPadding: null,
				position: 'bottom left',
				type: 'outline',	// outline, filled
				customWrapper: ''
			})
		}		
