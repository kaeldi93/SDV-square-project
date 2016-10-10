var paymentForm = new SqPaymentForm({
			applicationId: 'sq0idp-v5i80Lsah_2yMxeYYEt_Tw', // <-- Add your application ID here
   			inputClass: 'sq-input',
    		inputStyles: [{ }],
    		cardNumber: {elementId: 'cardNumber', placeholder: '0000 0000 0000 0000'},
    		cvv: {elementId: 'cVV'},
    		expirationDate: {elementId: 'expDate', placeholder: ' MM/YY'},
    		postalCode: {elementId: 'postalCode'},
    		callbacks: {
     			cardNonceResponseReceived: function(errors, nonce, cardData) {
        			if (errors) {
          				// handle errors
          				errors.forEach(function(error) { console.log(error.message); alert(error.message); });
        			} else {
          				// handle nonce
          				console.log('Nonce received:');
          				console.log(nonce);
						// alert('Nonce recieved: ' + nonce);
						document.getElementById("nonce_capture").value = nonce;
						document.getElementById("hidden_zip").value = cardData.billing_postal_code;
						document.getElementById("last_four").value = cardData.last_4;
						document.getElementById("card_type").value = cardData.card_brand;
						// alert('Card: ' + cardData.card_brand + cardData.last_4 + '\nExp: ' + cardData.exp_month + "/" + cardData.exp_year + '\nZip: ' + cardData.billing_postal_code);
						console.log(document.getElementById("nonce_capture").value);
						document.getElementById("donate1").style.visibility= "hidden";
						document.getElementById("donate2").style.visibility= "visible";
        			}
      			},
     			unsupportedBrowserDetected: function() {
       				// Alert the buyer that their browser is not supported
					alert('Oops! Your browser is not supported');
      			},
      			/**inputEventReceived: function(inputEvent) {
       				switch (inputEvent.eventType) {
          				case 'focusClassAdded':
            				// Handle as desired
            				break;
         				case 'focusClassRemoved':
            				// Handle as desired
            				break;
          				case 'errorClassAdded':
            				// Handle as desired
           	 				break;
          				case 'errorClassRemoved':
            				// Handle as desired
            				break;
          				case 'cardBrandChanged':
            				// Handle as desired
            				break;
          				case 'postalCodeChanged':
            				// Handle as desired
            				break;
        			}
      			}**/
    		}
  		});
		function requestCardNonce() {
			paymentForm.requestCardNonce();
		}