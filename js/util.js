var totalMainQues=1;

function generatePaperForm(tr)
{
	var table=tr.parentElement;
	var newTr=document.createElement('tr');
	var inputs='<td><i class="fa fa-window-close rmvQueBtn" onclick="rmvQue(this.parentElement)"></i></td><td><input type="number" min="1" name="mark'+totalMainQues+'" class="paperInputs mark"></td><td><input type="number" min="1" name="totalQue'+totalMainQues+'" class="paperInputs totalQue"></td><td><input type="number" min="1" name="compQue'+totalMainQues+'" class="paperInputs compQue"></td>';
	newTr.innerHTML=inputs;
	table.insertBefore(newTr,tr);
	totalMainQues++;
	document.getElementsByName('maxQueGone')[0].value=totalMainQues-1;
}

function rmvQue(tr)
{
	tr.parentElement.parentElement.removeChild(tr.parentElement);
	// console.log(tr);
}

function validateForm()
{
	var examName=document.getElementById('examName').value;
	var totalMarks=Number(document.getElementsByName('totalMarks')[0].value);
	if(examName=="" || totalMarks=="")
	{
		document.getElementById('errorStatus2').innerHTML="Any input cannot be left blank.";
		window.scrollTo(0,0);
		return false;
	}
	else
	{	
		document.getElementById('errorStatus2').innerHTML="";
	}
	var marks=document.getElementsByClassName('mark');
	var totalQue=document.getElementsByClassName('totalQue');
	var compQue=document.getElementsByClassName('compQue');
	var errorStatus=document.getElementById('errorStatus');
	var total=0;
	var markQues={};
	for(var i=0;i<marks.length;i++)
	{
		if(marks[i].value=="" || totalQue[i].value=="" || compQue=="")
		{
			errorStatus.innerHTML="Any input can't be left blank.";
			return false;
		}
		// console.log(totalQue[i].value+compQue[i].value);
		if(parseInt(totalQue[i].value)<parseInt(compQue[i].value))
		{
			errorStatus.innerHTML="Total Number of Question can't be less than total compulsory question in question number "+(i+1)+".";
			return false;
		}
		total+=marks[i].value*compQue[i].value;
		if(markQues.hasOwnProperty(marks[i].value))
		{
			markQues[marks[i].value]=parseInt(markQues[marks[i].value])+parseInt(totalQue[i].value);
		}
		else
		{
			markQues[marks[i].value]=parseInt(totalQue[i].value);	
		}
	}
	var sub=document.getElementById('subjectBox').value;
	if(!markQueLimit.hasOwnProperty(sub))
	{
			errorStatus.innerHTML="Questions of "+subjectCast[sub]+" are not available with us! Mail questions if you wish to mehtavatsald02@gmail.com";
			return false;
	}
	for(que in markQues)
	{
		if(!markQueLimit[sub].hasOwnProperty(que))
		{
			errorStatus.innerHTML="Sufficent Questions of "+que+" marks are not available.Change paper style if possible!";
			return false;
		}
		else if (markQueLimit[sub][que]<markQues[que]) {
			errorStatus.innerHTML="Sufficent Questions of "+que+" marks are not available.Change paper style if possible!";
			return false;
		}
	}
	console.log(markQues);
	if(total!=totalMarks)
	{
		errorStatus.innerHTML="Total Marks is not matching with your Paper Style.";
		return false;
	}
	errorStatus.innerHTML="";
	return true;
}

var cnt=0;
function dropDownShower() {
	if(cnt%2==0)
	{
		document.getElementsByClassName('dropDown')[0].style.display='block';
		document.getElementsByClassName('dropDownBack')[0].style.display='block';
		cnt++;
	}
	else if(cnt%2==1)
	{
		document.getElementsByClassName('dropDown')[0].style.display='none';
		document.getElementsByClassName('dropDownBack')[0].style.display='none';
		cnt++;
	}
}

function hideDropDown(){
	cnt++;
	document.getElementsByClassName('dropDown')[0].style.display='none';
	document.getElementsByClassName('dropDownBack')[0].style.display='none';
}

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('showProPic').setAttribute('src',e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }

    if(input.value!="")
    {
    	var error=document.getElementsByClassName(errorClasses['null']+'Of'+'uploadButton')[0];
    	if(error)
    		error.parentElement.removeChild(error);
    }
    else
    {
    	document.getElementById('showProPic').src='propics/default.png';
    }
}

function handleHeight(textarea,height){
	textarea.style.height=height+'px';
	textarea.style.height=((height/2)+textarea.scrollHeight)+'px';
}

function editQuestion(e,srno,id)
{
	var td=e.target.parentElement;
	var tr=td.parentElement;
	var td=tr.getElementsByTagName('td')[1];
	var question=td.innerHTML;
	var textarea=document.createElement('textarea');
	textarea.innerHTML=question;
	textarea.setAttribute('class','editTextArea');
	textarea.setAttribute('id','editTextArea');
	td.innerHTML="";
	td.appendChild(textarea);
	textarea.focus();
	textarea.setAttribute('onblur','saveEditedQue('+id+')');
}