var errorNotices={
	'null' : 'Input field is required',
	'length' : 'Length should be ',
	'invalidMail' : 'Invalid email-id',
	'invalidMobno' : 'Invalid mobile number',
	'matchWith' : 'Should match with '
};

var errorClasses={
	'null':'nullTypeError',
	'length':'lengthError',
	'type':'invalidTypeError',
	'matchWith':'matchWithError'
};

function validateInput(validate){
	var element=document.getElementsByClassName(validate["class"])[0];
	if(validate["null"]=="true"){
		var classToGive=errorClasses["null"]+"Of"+validate["class"];
		var errorElement=document.getElementsByClassName(classToGive)[0];
		if(element.value==""){
			if(!errorElement){
				for(var key in errorClasses)
				{
					var remEle=document.getElementsByClassName(errorClasses[key]+"Of"+validate["class"])[0];
					if(remEle)
					{
						remEle.parentElement.removeChild(remEle);
					}
				}
				var errorElement=createErrorNotice(errorNotices["null"],classToGive);
				element.parentElement.insertBefore(errorElement,element);
			}
			return false;
		}
		else{
			if(errorElement){
				element.parentElement.removeChild(errorElement);
			}
		}
	}

	if(validate.hasOwnProperty('length')){
		var classToGive=errorClasses["length"]+"Of"+validate["class"];
		var errorElement=document.getElementsByClassName(classToGive)[0];
		var param=validate["length"].split(' ')[0];
		var length=validate["length"].split(' ')[1];
		switch(param){
			case "atleast" : 
				if(element.value.length<length){
					if(!errorElement){
						for(var key in errorClasses)
						{
							var remEle=document.getElementsByClassName(errorClasses[key]+"Of"+validate["class"])[0];
							if(remEle)
							{
								remEle.parentElement.removeChild(remEle);
							}
						}
						var errorElement=createErrorNotice(errorNotices["length"]+' '+param+' '+length,classToGive);
						element.parentElement.insertBefore(errorElement,element);
					}
					return false;
				}
				else{
					if(errorElement){
						element.parentElement.removeChild(errorElement);
					}
				}
				break;
			case "atmost" : 
				if(element.value.length>length){
					if(!errorElement){
						for(var key in errorClasses)
						{
							var remEle=document.getElementsByClassName(errorClasses[key]+"Of"+validate["class"])[0];
							if(remEle)
							{
								remEle.parentElement.removeChild(remEle);
							}
						}
						var errorElement=createErrorNotice(errorNotices["length"]+' '+param+' '+length,classToGive);
						element.parentElement.insertBefore(errorElement,element);
					}
					return false;
				}
				else{
					if(errorElement){
						element.parentElement.removeChild(errorElement);
					}
				}
				break;
			case "equals" : 
				if(element.value.length!=length){
					if(!errorElement){
						for(var key in errorClasses)
						{
							var remEle=document.getElementsByClassName(errorClasses[key]+"Of"+validate["class"])[0];
							if(remEle)
							{
								remEle.parentElement.removeChild(remEle);
							}
						}
						var errorElement=createErrorNotice(errorNotices["length"]+' '+param+' '+length,classToGive);
						element.parentElement.insertBefore(errorElement,element);
					}
					return false;
				}
				else{
					if(errorElement){
						element.parentElement.removeChild(errorElement);
					}
				}
				break;
		}
	}

	if(validate.hasOwnProperty('type')){
		var classToGive=errorClasses["type"]+"Of"+validate["class"];
		var errorElement=document.getElementsByClassName(classToGive)[0];
		switch(validate["type"]){
			case 'mail':
				var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if(!regex.test(element.value)){
					if(!errorElement){
						for(var key in errorClasses)
						{
							var remEle=document.getElementsByClassName(errorClasses[key]+"Of"+validate["class"])[0];
							if(remEle)
							{
								remEle.parentElement.removeChild(remEle);
							}
						}
						var errorElement=createErrorNotice(errorNotices["invalidMail"],classToGive);
						element.parentElement.insertBefore(errorElement,element);
					}
					return false;
				}
				else{
					if(errorElement){
						element.parentElement.removeChild(errorElement);
					}
				}
				break;	
			case 'mobileNumber':
				if(isNaN(element.value) || element.value.length!=10){
					if(!errorElement){
						for(var key in errorClasses)
						{
							var remEle=document.getElementsByClassName(errorClasses[key]+"Of"+validate["class"])[0];
							if(remEle)
							{
								remEle.parentElement.removeChild(remEle);
							}
						}
						var errorElement=createErrorNotice(errorNotices["invalidMobno"],classToGive);
						element.parentElement.insertBefore(errorElement,element);
					}
					return false;
				}
				else{
					if(errorElement){
						element.parentElement.removeChild(errorElement);
					}
				}
				break;				
		}
	}

	if(validate.hasOwnProperty('matchWith')){
		var classToGive=errorClasses["matchWith"]+"Of"+validate["class"];
		var errorElement=document.getElementsByClassName(classToGive)[0];
		var matchClass=validate['matchWith'].split(',')[0];
		var matchWord=validate['matchWith'].split(',')[1];
		var matchElement=document.getElementsByClassName(matchClass)[0];
		if(element.value!=matchElement.value){
			if(!errorElement){
				for(var key in errorClasses)
				{
					var remEle=document.getElementsByClassName(errorClasses[key]+"Of"+validate["class"])[0];
					if(remEle)
					{
						remEle.parentElement.removeChild(remEle);
					}
				}
				var errorElement=createErrorNotice(errorNotices["matchWith"]+matchWord,classToGive);
				element.parentElement.insertBefore(errorElement,element);
			}
			return false;
		}
		else{
			if(errorElement){
				element.parentElement.removeChild(errorElement);
			}
		}
	}
	return true;
}

function setValidatorFunction(validate){
	for(var i=0;i<validate.length-1;i++){
		console.log(validate[i]["class"]);
		var inputElement=document.getElementsByClassName(validate[i]["class"])[0];
		inputElement.setAttribute('onblur','validateInput(validate['+i+'])');
		inputElement.setAttribute('oninput','validateInput(validate['+i+'])');
	}
	document.getElementsByClassName(validate[validate.length-1])[0].setAttribute('onsubmit','return submitValidator(validate)');
}

function submitValidator(validate){
	for(var i=0;i<validate.length-1;i++){
		if(!validateInput(validate[i]))
			return false;
	}
	return true;
}

function createErrorNotice(errorText,errorClass){
	var span=document.createElement('span');
	span.classList.add('error');
	span.classList.add(errorClass);
	span.innerHTML=errorText;
	return span;
}