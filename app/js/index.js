////////////////////////////////////////////////////
//				Global arrays
////////////////////////////////////////////////////
var inputRadioArray = document.querySelectorAll('input[type="radio"]');
var fieldsetArray = document.querySelectorAll("fieldset");
var closeButton = document.querySelectorAll(".close");

////////////////////////////////////////////////////
//				Main navigation tabs
////////////////////////////////////////////////////
var tabUploadFiles = document.getElementById("tab-rawfile");
var tabSelectFiles = document.getElementById("tab-selectfile");
var tabParameters = document.getElementById("tab-parameter");

var rawFileSec = document.getElementById("rawfile-wrapper");
var selectDatabaseSec = document.getElementById("select-database-wrapper");
var parameterSec = document.getElementById("parameter-wrapper");

var sessionSubmitBtn = document.getElementById("session-submit-label-wrapper");

if(tabUploadFiles){
	tabUploadFiles.addEventListener("click", function(){
		tabUploadFiles.setAttribute("class", "active");
		tabSelectFiles.removeAttribute("class", "active");
		tabParameters.removeAttribute("class", "active");
		rawFileSec.style.display="block";
		selectDatabaseSec.style.display="none";
		parameterSec.style.display="none";
		//buttons
		rawFileNextBtn.style.display="block";
	});
}

if(tabSelectFiles){
	tabSelectFiles.addEventListener("click", function(){
		tabUploadFiles.removeAttribute("class", "active");
		tabSelectFiles.setAttribute("class", "active");
		tabParameters.removeAttribute("class", "active");
		rawFileSec.style.display="none";
		selectDatabaseSec.style.display="block";
		parameterSec.style.display="none";
		//buttons
		databaseNextBtn.style.display="block";
	});
}

if(tabParameters){
	tabParameters.addEventListener("click", function(){
		tabUploadFiles.removeAttribute("class", "active");
		tabSelectFiles.removeAttribute("class", "active");
		tabParameters.setAttribute("class", "active");
		rawFileSec.style.display="none";
		selectDatabaseSec.style.display="none";
		parameterSec.style.display="block";
		//buttons
		sessionSubmitBtn.style.display="block";
	});
}

////////////////////////////////////////////////////
//				Page specific navigation buttons
////////////////////////////////////////////////////

//close select raw file modal
if(closeButton[0]){
	closeButton[0].addEventListener("click", function(){
		document.getElementById("select-rawfile-wrapper").setAttribute("style", "display:none");
	});
}

//next step buttons click eventlistener
var rawFileNextBtn = document.getElementById("rawfile-nextBtn-label");
if(rawFileNextBtn){
	rawFileNextBtn.addEventListener("click",function(){
		tabUploadFiles.removeAttribute("class", "active");
		tabSelectFiles.setAttribute("class", "active");
		tabParameters.removeAttribute("class", "active");
		rawFileSec.style.display="none";
		selectDatabaseSec.style.display="block";
		parameterSec.style.display="none";
		rawFileNextBtn.style.display="none";
	});
}

var databaseNextBtn = document.getElementById("database-nextBtn-label");
if(databaseNextBtn){
	databaseNextBtn.addEventListener("click", function(){
		tabUploadFiles.removeAttribute("class", "active");
		tabSelectFiles.removeAttribute("class", "active");
		tabParameters.setAttribute("class", "active");
		rawFileSec.style.display="none";
		selectDatabaseSec.style.display="none";
		parameterSec.style.display="block";
		//buttons
		databaseNextBtn.style.display="none";
	});
}


////////////////////////////////////////////////////
//				Select Raw files
////////////////////////////////////////////////////
var generateUploadBtn = document.getElementById("generateUploadBtn");
var showRawFileListBtn = document.getElementById("open-select-rawfile-label");
var submitSelectedRawfiles = document.getElementById("selectedRawFileListSubmitLable");
//var divRawList = document.getElementById("selected-rawfile-list-wrapper");
var insertSelectedRawList = document.getElementById("insert-selected-rawfiles");
var uploadMessage = document.getElementById("upload-msg-wrapper");

if(generateUploadBtn){
	generateUploadBtn.addEventListener("click", function(){
		var newInput = document.createElement("input");
		var newDiv = document.createElement("div");
		newInput.setAttribute("type", "file");
		newInput.setAttribute("name", "RawFileToUpload[]");
		newInput.setAttribute("style", "margin:10px");
		newDiv.appendChild(newInput);
		document.getElementById("raw-files-upload").insertBefore(newDiv, document.getElementById("generateUploadBtn"));
	});
}

if(showRawFileListBtn){
	showRawFileListBtn.addEventListener("click", function(){
		//alert("open");
		document.getElementById("select-rawfile-wrapper").setAttribute("style", "display:block");
		//uploadMessage.innerHTML="";
	});
}

var rawFileList = document.querySelectorAll("input.raw-file-list");
var selectedRawFiles = [];
console.log(rawFileList);
console.log(selectedRawFiles);

for(var i = 0; i < rawFileList.length; i++){
	rawFileList[i].addEventListener("change", checkBoxStats(i), false);
}

function checkBoxStats(num){
	return function(){
		if(rawFileList[num].checked){
			selectedRawFiles.push(rawFileList[num].value);
		}else if(!rawFileList[num].checked){
			console.log("gonna remove" + rawFileList[num].value);
			removeRawFile(num);
		}
		console.log(selectedRawFiles);
	}
}

function removeRawFile(index){
	for(var n = 0; n<selectedRawFiles.length; n++){
		if(selectedRawFiles[n] == rawFileList[index].value){
			selectedRawFiles.splice(n, 1);
		}
	}
}

//generate selected raw file list
if(submitSelectedRawfiles){
	submitSelectedRawfiles.addEventListener("click", function(){
		console.log(selectedRawFiles);
		insertSelectedRawList.innerHTML="";
		document.getElementById("select-rawfile-wrapper").setAttribute("style", "display:none");
		var ulRawList = document.createElement("ul");

		for (var j = 0; j< selectedRawFiles.length; j++){
			var liRawList = document.createElement("li");
			var input = document.createElement("input");
			input.setAttribute("type", "hidden");
			input.setAttribute("name", "selectedRawFileList[]");
			input.setAttribute("value", selectedRawFiles[j]);
			var txtInput = document.createElement("input");
			txtInput.setAttribute("type", "text");
			txtInput.setAttribute("name", "experiments[]");
			var text = document.createTextNode(selectedRawFiles[j]);
			liRawList.appendChild(txtInput);
			liRawList.appendChild(text); 
			liRawList.appendChild(input);

			ulRawList.appendChild(liRawList);
		}
		insertSelectedRawList.appendChild(ulRawList);
	});
}

////////////////////////////////////////////////////
//				Isotope label tabs
////////////////////////////////////////////////////
var tabLight = document.getElementById("tab-light");
var tabMedium = document.getElementById("tab-medium");
var tabHeavy = document.getElementById("tab-heavy");
var lightIsotopeList = document.getElementById("isotope-section-light");
var mediumIsotopeList = document.getElementById("isotope-section-medium");
var heavyIsotopeList = document.getElementById("isotope-section-heavy");

if(tabLight){
	tabLight.addEventListener("click", function(){
		//alert("show table one");
		tabLight.setAttribute("class", "active");
		tabMedium.removeAttribute("class", "active");
		tabHeavy.removeAttribute("class", "active");
		lightIsotopeList.style.display="block";
		mediumIsotopeList.style.display="none";
		heavyIsotopeList.style.display="none";
	});	
}

if(tabMedium){
	tabMedium.addEventListener("click", function(){
		//alert("show table two");
		tabLight.removeAttribute("class", "active");
		tabMedium.setAttribute("class", "active");
		tabHeavy.removeAttribute("class", "active");
		lightIsotopeList.style.display="none";
		mediumIsotopeList.style.display="block";
		heavyIsotopeList.style.display="none";
	});
}

if(tabHeavy){
		tabHeavy.addEventListener("click", function(){
		//alert("show table two");
		tabLight.removeAttribute("class", "active");
		tabMedium.removeAttribute("class", "active");
		tabHeavy.setAttribute("class", "active");
		lightIsotopeList.style.display="none";
		mediumIsotopeList.style.display="none";
		heavyIsotopeList.style.display="block";
	});
}


/**************custom functions************/
//loop through fieldsets and return the one with correct "id"
function obtainFiledsets(array, id){
	//console.log(array);
	for (var i = 0; i < array.length; i++){
		if(array[i].getAttribute("id") == id){
			console.log("found: "+ id);
			return array[i];
		}
		else{
			//for testing uses
			//console.log("nothing found at " + i);
		}
	}
}
