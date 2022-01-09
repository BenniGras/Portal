"use strict"

const form = document.getElementById('form');
const email = document.getElementById('email');
const firstname = document.getElementById('firstname');
const surname = document.getElementById('surname');
const zipcode = document.getElementById('zipcode');
const city = document.getElementById('city');
const password_1 = document.getElementById('password_1');
const password_2 = document.getElementById('password_2');
const phone = document.getElementById('customer_phone');
const customerEmail = document.getElementById('customer_email');
const agb = document.getElementById('agb');
const ds = document.getElementById('ds');

let error = [];

const onlyNumbers = (e) => {
	if (e.which != 8 && e.which != 0 && e.which < 48 || e.which > 57) {
		e.preventDefault();
	}
}

const emailValidation = () => {
	const emailValue = email.value.trim();

	if(emailValue === '') {
		setErrorFor(email, 'Bitte geben Sie Ihre E-Mail an.');
	} else if (emailValue.length > 255) {
		setErrorFor(email, 'Die Email darf maximal 255 Zeichen haben.');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Bitte geben Sie eine gültige E-Mail an.');
	} else {
		setSuccessFor(email);
	}
}

const firstnameValidation = () => {
	const firstnameValue = firstname.value.trim();

	if(firstnameValue === '') {
		setErrorFor(firstname, 'Bitte geben Sie Ihren Firmennamen an.');
	} else if (firstnameValue.length > 40) {
		setErrorFor(firstname, 'Der Vorname darf maximal 40 Zeichen haben.');
	} else {
		setSuccessFor(firstname);
	}
}

const surnameValidation = () => {
	const surnameValue = surname.value.trim();

	if(surnameValue === '') {
		setErrorFor(surname, 'Bitte geben Sie Ihren Firmennamen an.');
	} else if (surnameValue.length > 40) {
		setErrorFor(surname, 'Der Nachname darf maximal 40 Zeichen haben.');
	} else {
		setSuccessFor(surname);
	}
}

const zipcodeValidation = () => {
	const zipcodeValue = zipcode.value.trim();

	if(zipcodeValue === '') {
		setErrorFor(zipcode, 'Bitte geben Sie Ihre PLZ an.');
	}else if(zipcodeValue.length !== 5) {
		setErrorFor(zipcode, 'Die PLZ hat 5 Stellen.');
	} else {
		setSuccessFor(zipcode);
	}
}

const cityValidation = () => {
	const cityValue = city.value.trim();

	if(cityValue === '') {
		setErrorFor(city, 'Bitte geben Sie Ihre Stadt an.');
	} else if (cityValue.length > 40) {
		setErrorFor(city, 'Der Name der Stadt darf maximal 40 Zeichen haben.');
	} else {
		setSuccessFor(city);
	}
}

const password1Validation = () => {
	const passwordValue = password_1.value.trim();

	if(passwordValue === '') {
		setErrorFor(password_1, 'Bitte geben Sie ein Passwort an.');
	} else if(passwordValue.length <= 3) {
		setErrorFor(password_1, 'Das Passwort muss mindestens 4 Zeichen enthalten.');
	} else {
		setSuccessFor(password_1);
	}
}

const password2Validation = () => {
	const passwordValue = password_1.value.trim();
	const password2Value = password_2.value.trim();

	if(passwordValue === '') {
		setErrorFor(password_2, 'Bitte geben Sie ein Passwort an.');
	} else if(password2Value === '') {
		setErrorFor(password_2, 'Bitte wiederholen Sie das Passwort.');
	} else if(passwordValue !== password2Value) {
		setErrorFor(password_2, 'Die Passwörter stimmen nicht überein');
	} else{
		setSuccessFor(password_2);
	}
}

const phoneValidation = () => {
	const phoneValue = phone.value.trim();

	if(phoneValue === '') {
		setSuccessFor(phone);
	} else if(!/^\d+$/.test(phoneValue)) {
		setErrorFor(phone, 'Bitte geben Sie eine gültige Telefonnummer ein.');
	} else{
		setSuccessFor(phone);
	}
}
const customerEmailValidation = () => {
	const customerEmailValue = customerEmail.value.trim();

	if(customerEmailValue === '') {
		setSuccessFor(customerEmail);
	} else if (customerEmailValue.length > 255) {
		setErrorFor(customerEmail, 'Die Email darf maximal 255 Zeichen haben.');
	} else if (!isEmail(customerEmailValue)) {
		setErrorFor(customerEmail, 'Bitte geben Sie eine gültige E-Mail an.');
	} else {
		setSuccessFor(customerEmail);
	}
}

const agbValidation = () => {
	const agbChecked = agb.checked;

	if(agbChecked) {
        const formControl = agb.parentElement.parentElement;
        formControl.className = 'form-control success';
    
        if (error.includes(agb.name)){
            error.splice(error.indexOf(agb.name,0));
        }
	} else {
		const formControl = agb.parentElement.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'form-control error';
        small.innerText = 'Sie müssen den AGBs der buyCycle GmbH zustimmen.';

        if (!error.includes(agb.name)){
		error.push(agb.name);
	    }
	}
}

const dsValidation = () => {
	const dsChecked = ds.checked;

	if(dsChecked) {
        const formControl = ds.parentElement.parentElement;
        formControl.className = 'form-control success';
    
        if (error.includes(ds.name)){
            error.splice(error.indexOf(ds.name,0));
        }
	} else {
		const formControl = ds.parentElement.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'form-control error';
        small.innerText = 'Sie müssen der Datenschutzerklärung der buyCycle GmbH zustimmen.';

        if (!error.includes(ds.name)){
		error.push(ds.name);
	    }
	}
}

form.addEventListener('submit', (e) => {
	checkInputs();
	if(error.length > 0){
		e.preventDefault();	
	}
});

email.addEventListener("change", emailValidation);
firstname.addEventListener("change", firstnameValidation);
surname.addEventListener("change", surnameValidation);	
zipcode.addEventListener("change", zipcodeValidation);
zipcode.addEventListener("keypress", onlyNumbers);
city.addEventListener("change", cityValidation);
password_1.addEventListener("change", password1Validation);
password_2.addEventListener("change", password2Validation);
phone.addEventListener("change", phoneValidation);
phone.addEventListener("keypress", onlyNumbers);
customerEmail.addEventListener("change", customerEmailValidation);
agb.addEventListener("change", agbValidation);
ds.addEventListener("change", dsValidation);


function checkInputs() {
	emailValidation();
	firstnameValidation();
	surnameValidation();
	zipcodeValidation();
	cityValidation();
	password1Validation();
	password2Validation();
	phoneValidation();
	customerEmailValidation();
	agbValidation();
	dsValidation();
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;

	if (!error.includes(input.id)){
		error.push(input.id);
	}
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';

	if (error.includes(input.id)){
		error.splice(error.indexOf(input.id,0));
	}
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}