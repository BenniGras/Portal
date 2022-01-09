"use strict"

const form = document.getElementById('form');
const title = document.getElementById('title');
const description = document.getElementById('description');
const price = document.getElementById('price');
const status = document.getElementsByName('status');

let error = [];

const onlyNumbers = (e) => {
	if (e.which != 8 && e.which != 0 && e.which < 48 || e.which > 57) {
		e.preventDefault();
	}
}

const titleValidation = () => {
	const titleValue = title.value.trim();

	if(titleValue === '') {
		setErrorFor(title, 'Bitte geben Sie einen Titel an.');
	} else {
		setSuccessFor(title);
	}
}

const descriptionValidation = () => {
	const descriptionValue = description.value.trim();

	if(descriptionValue === '') {
		setErrorFor(description, 'Bitte geben Sie eine Beschreibung an.');
	} else {
		setSuccessFor(description);
	}
}

const priceValidation = () => {
	const priceValue = price.value.trim();

	if(priceValue === '') {
		setErrorFor(price, 'Bitte geben Sie einen Preis an.');
	} else if(!/^\d+$/.test(priceValue)) {
		setErrorFor(price, 'Der Preis darf keine Buchstaben enthalten.');
	} else {
		setSuccessFor(price);
	}
}

const status1Validation = () => {
	const status1 = status[0].checked;
    const status2 = status[1].checked;

	if(status1 || status2) {
        const formControl = status[0].parentElement.parentElement;
        formControl.className = 'form-control success';
    
        if (error.includes(status[1].name)){
            error.splice(error.indexOf(status[1].name,0));
        }
	} else {
		const formControl = status[0].parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'form-control error';
        small.innerText = 'Bitte geben Sie den Status an.';

        if (!error.includes(status[1].name)){
		error.push(status[1].name);
	    }
	}
}

const status2Validation = () => {
	const status1 = status[0].checked;
    const status2 = status[1].checked;

	if(status1 || status2) {
        const formControl = status[1].parentElement.parentElement;
        formControl.className = 'form-control success';
    
        if (error.includes(status[1].name)){
            error.splice(error.indexOf(status[1].name,0));
        }
	} else {
		const formControl = status[1].parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'form-control error';
        small.innerText = 'Bitte geben Sie den Status an.';

        if (!error.includes(status[1].name)){
		error.push(status[1].name);
	    }
	}
}
 
form.addEventListener('submit', (e) => {
	checkInputs();
	if(error.length > 0){
		e.preventDefault();	
	}
});

title.addEventListener("change", titleValidation);	
description.addEventListener("change", descriptionValidation);
price.addEventListener("change", priceValidation);
price.addEventListener("keypress", onlyNumbers);
status[0].addEventListener("change", status1Validation);
status[1].addEventListener("change", status2Validation);

function checkInputs() {
	titleValidation();
	descriptionValidation();
	priceValidation();
	status1Validation();
	status2Validation();
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

description.addEventListener("keyup", (e) => {
	let length = description.value.length;
	let text = document.getElementById('characters');
	if (length < 100) {
		text.innerHTML = "Noch " + "<em>" + (100 - length) + "</em>" + " Zeichen";
	} else if ( length == 100) {
		text.innerText = "Das Zeichenlimit wurde erreicht";
	} else {
		text.innerHTML = "<em>" + (length - 100) + "</em>" + " Zeichen zu viel";
	}

});