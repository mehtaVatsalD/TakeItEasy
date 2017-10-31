function changeExamType(examType,keepAllField)
{
	var clgSelectBox=document.getElementById('instituteBox');

	var subSelectBox=document.getElementById('subjectBox');
	
	var marksBox=document.getElementById('marksBox');

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var resp=JSON.parse(this.responseText);
			if(clgSelectBox)
			{
				clgSelectBox.innerHTML="";
				if(keepAllField)
				{
					var option=document.createElement("option");
					option.setAttribute("value","0all");
					option.innerHTML="All";
					clgSelectBox.appendChild(option);
				}
				for(var i=0;i<resp[0].length;i++)
				{
					var option=document.createElement("option");
					option.setAttribute("value",resp[0][i]);
					option.innerHTML=clgNameCast[resp[0][i]];
					clgSelectBox.appendChild(option);
				}
			}

			if(subSelectBox)
			{
				subSelectBox.innerHTML="";
				if(keepAllField)
				{
					var option=document.createElement("option");
					option.setAttribute("value","0all");
					option.innerHTML="All";
					subSelectBox.appendChild(option);
				}
				for(var i=0;i<resp[1].length;i++)
				{
					var option=document.createElement("option");
					option.setAttribute("value",resp[1][i]);
					option.innerHTML=subjectCast[resp[1][i]];
					subSelectBox.appendChild(option);
				}
			}

			if(marksBox)
			{
				marksBox.innerHTML="";
				if(keepAllField)
				{
					var option=document.createElement("option");
					option.setAttribute("value","0all");
					option.innerHTML="All";
					marksBox.appendChild(option);
				}
				for(var i=0;i<resp[2].length;i++)
				{
					var option=document.createElement("option");
					option.setAttribute("value",resp[2][i]);
					option.innerHTML=resp[2][i];
					marksBox.appendChild(option);
				}
			}
				
			if(keepAllField)
			{
				updateShowQuestion();
			}
			// console.log(resp);

		}
	};
	xhttp.open("GET", "ajax/changeExamType.php?examType="+examType, true);
	xhttp.send();
}

function changeSubject(subject,keepAllField)
{
	var marksBox=document.getElementById('marksBox');
	var examType=document.getElementsByName('instituteType')[0].value;	

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var resp=JSON.parse(this.responseText);
			if(marksBox)
			{
				marksBox.innerHTML="";
				if(keepAllField)
				{
					var option=document.createElement("option");
					option.setAttribute("value","0all");
					option.innerHTML="All";
					marksBox.appendChild(option);
				}
				for(var i=0;i<resp.length;i++)
				{
					var option=document.createElement("option");
					option.setAttribute("value",resp[i]);
					option.innerHTML=resp[i];
					marksBox.appendChild(option);
				}
			}
			if(keepAllField)
			{
				updateShowQuestion();
			}
		}
	};
	xhttp.open("GET", "ajax/changeSubject.php?subject="+subject+"&examType="+examType, true);
	xhttp.send();
}

function updateShowQuestion()
{
	var examType=document.getElementsByName('instituteType')[0].value;
	var subject=document.getElementById('subjectBox').value;
	var marks=document.getElementById('marksBox').value;

	var tbody=document.getElementById('questionsToEdit');

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var data=JSON.parse(this.responseText);
			var srno=1;
			var toPrint='';
			for(var i=0;i<data[0].length;i++)
			{
				toPrint+="<tr><td>"+srno+"</td>"+"<td>"+data[0][i]+"</td>"+"<td>"+data[1][i]+"</td>"+"<td><i class='fa fa-pencil editBtnQue' onclick='editQuestion(event,"+srno+","+data[2][i]+")'></i></td><td><i class='fa fa-window-close deleteBtnQue' onclick='deleteQuestion(event,"+srno+","+data[2][i]+")'></i></td></tr>";
				srno++;
			}
			if(srno==1)
				toPrint="<tr><td colspan='5'>No Questions Found!</td></tr>"
			tbody.innerHTML=toPrint;
			// console.log(data);
		}
	};
	xhttp.open("GET", "ajax/updateShowQuestion.php?examType="+examType+"&subject="+subject+"&marks="+marks, true);
	xhttp.send();
}

function saveEditedQue(id)
{
	var textarea=document.getElementById('editTextArea');
	var question=textarea.value;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			textarea.parentElement.innerHTML=question;
			// console.log(question);
		}
	};
	xhttp.open("GET", "ajax/saveEditedQue.php?id="+id+"&question="+question, true);
	xhttp.send();
}

function deleteQuestion(e,srno,id,newQue)
{
	var td=e.target.parentElement;
	var tr=td.parentElement;
	var tbody=tr.parentElement;
	tbody.removeChild(tr);
	// var tbody=document.getElementById('questionsToEdit');
	// var tr=tbody.getElementsByTagName('tr')[srno-1];
	// tbody.removeChild(tr);

	if(newQue)
	{
		var url="ajax/deleteQuestionNew.php?id="+id;
	}
	else
	{
		var url="ajax/deleteQuestion.php?id="+id;
	}

	var xhttp = new XMLHttpRequest();
	// xhttp.onreadystatechange = function() {
	// 	if (this.readyState == 4 && this.status == 200) {
			
	// 	}
	// };
	xhttp.open("GET",url, true);
	xhttp.send();
	
}

function blockUser(userName,srno,status)
{
	var tr=document.getElementsByClassName('userBlockRow')[srno];
	var td=tr.getElementsByTagName('td')[3];
	if(status=="blocked")
	{
		td.innerHTML="<button class='buttons' onclick=\"blockUser('"+userName+"',"+srno+",'notBlocked')\">Block</button>"
	}
	else
	{
		td.innerHTML="<button class='buttons' onclick=\"blockUser('"+userName+"',"+srno+",'blocked')\">Unblock</button>"
	}
	var xhttp = new XMLHttpRequest();
	// xhttp.onreadystatechange = function() {
	// if (this.readyState == 4 && this.status == 200) {
		
	// }
	// };
	xhttp.open("GET", "ajax/blockUser.php?userName="+userName, true);
	xhttp.send();
}

function searchUser(data)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById('usersList').innerHTML=this.responseText
	}
	};
	xhttp.open("GET", "ajax/searchUser.php?data="+data, true);
	xhttp.send();
}

function searchQuestion(data)
{
	var examType=document.getElementsByName('instituteType')[0].value;
	var subject=document.getElementById('subjectBox').value;
	var marks=document.getElementById('marksBox').value;

	var tbody=document.getElementById('questionsToEdit');

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			tbody.innerHTML=this.responseText;
		}
	};
	xhttp.open("GET", "ajax/searchQuestion.php?examType="+examType+"&subject="+subject+"&marks="+marks+"&data="+data, true);
	xhttp.send();
}

function approveQue(e,srno,id)
{
	var td=e.target.parentElement;
	var tr=td.parentElement;
	var tbody=tr.parentElement;
	tbody.removeChild(tr);
	var xhttp = new XMLHttpRequest();
	// xhttp.onreadystatechange = function() {
	// 	if (this.readyState == 4 && this.status == 200) {
			
	// 	}
	// };
	xhttp.open("GET", "ajax/approveQue.php?id="+id, true);
	xhttp.send();
}

