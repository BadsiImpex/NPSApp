let dropDown1 = ['CONSIERGE','CONSILIER TEHNIC','CONSILIER DAUNE'];
let dropDown2= ['CONSIERGE','Tudor Zodie'];
let dropDown3=['CONSILIER TEHNIC','Alina Bunica','Gheorghe Adrian','Georgeta Enciu'];
let dropDown4=['CONSILIER DAUNE','Gabriela Mircea','Istrate George','Gheorghe Dumitru','Buzica Andrei'];
let feedbackGeneral=['Consierge','Consilier Tehnic','Consilier Daune'];
let allFeedback = ['Promoters', 'Neutral', 'Detractor'];
let statusD1 = "closed";
let statusD2 = "closed";
let subMenuIndex = 'none';
var tdData = [[1,2]] ;
var lblTdData = ['today'];
var yestData = [[5,8]];
var lblYestData = ['yesterday'];
var weekData = [  [1,30], [2,60] ,[3,6] ,[4,3] ,[5,13] ,[6,9] ,[7,33] ];
var lblWeekData = ['Day 1','Day 2','Day 3','Day 4','Day 5','Day 6','Day 7'];
var monthData = [ [1,15] , [10,17] , [13,6] , [5,8]];
var lblMonthData = ['Week one' , 'Week two' , 'Week three', 'Week four'];
var qtrData = [ [1,23] , [2,18.75] , [3,20] ];
var lblQtrData = ['Month one', 'Month two', 'Month three'];
var yearData = [ [4,15] , [3,11] , [6,8] , [2,7.8] , [1,6] , [1,45] , [1,12] , [1,7] , [1,3] , [1,4] , [1,8] , [1,7] , [1,2] ];
var lblYearData = [ 'M1', 'M2', 'M3', 'M4', 'M5', 'M6', 'M7', 'M8', 'M9', 'M10', 'M11', 'M12' ];
var allData = [ [2,5] , [6,8]];
var lblAllData = [ 'year 1' , 'year 2'];

function showFilters(){
    document.getElementById("clr").style.display = "block";
}
function closeFilters(grphPeriod,grphLbl){
    console.log(grphPeriod + " " + grphLbl);
    document.getElementById("clr").style.display = "none";
    document.getElementById("perfmGraph").getContext("2d").clearRect(0,0,480,260);
    var weekGraph = new graph(grphPeriod,grphLbl,"perfmGraph");
    weekGraph.line();
}

function dropLevel1(){
    if (statusD1 === "closed"){
            for (i=0; i<dropDown1.length ; i++) {
                 var attrFuncParam = "dropLevel("+i+")";
                 var numbers = document.createElement("P");
                 var num = document.createTextNode(dropDown1[i]);
                 numbers.setAttribute("onclick", attrFuncParam);
                 numbers.appendChild(num);
                 document.getElementById("dropDown1").appendChild(numbers);
            }
        statusD1 = "open";
    } else {
        document.getElementById("dropDown1").innerHTML="<p onclick=\"dropLevel1()\">GENERAL</p>";
        document.getElementById("dropDown2").innerHTML="";
        statusD1 = "closed";
        statusD2 = "closed";
    }
}


function dropFeedgen(){
    if ( statusD1 === "closed"){
        for ( i=0 ; i<feedbackGeneral.length ; i++){
            var dropParam = 'dropLevel('+i+')';
            var category = document.createElement('P');
            var cat = document.createTextNode(feedbackGeneral[i]);
            category.setAttribute('onclick', dropParam);
            category.appendChild(cat);
            document.getElementById('generalF').appendChild(category);
        }
        statusD1="open";
        } else {
            document.getElementById('generalF').innerHTML='<span onclick=\"dropFeedgen()\">General Feedback</span>';
            statusD1 = "closed";
        }
    }

function dropAllfeed(){
    if ( statusD1 === "closed") {
        for ( i=0; i<allFeedback.length ; i++){
            var feedback = document.createElement('P');
            var feed = document.createTextNode(allFeedback[i]);
            feedback.appendChild(feed);
            document.getElementById('allFeedback').appendChild(feedback);
        }
        statusD1="open";
    }else {
        document.getElementById('allFeedback').innerHTML="<span onclick=\"dropAllfeed()\">All feedback</span>";
        statusD1 = "closed";
    }
}


function dropLevel(x) {
    if (x === 0) {
        var arr = dropDown2;
        
    } else if(x === 1) {
        var arr = dropDown3;
        
    } else {
        var arr = dropDown4;
        
    }
    if (statusD2 === "closed") {
        for(i=0 ; i<arr.length ; i++) {
            var numbers = document.createElement("P");
            var num = document.createTextNode(arr[i]);
            numbers.setAttribute("class","marginMenuItem");
            numbers.setAttribute("onclick","displayInfo()");
            numbers.appendChild(num);
            document.getElementById("dropDown2").appendChild(numbers);
        }
     statusD2 = "open";
     subMenuIndex = x;
    } else {
        // close the submenu
        document.getElementById("dropDown2").innerHTML="";
        statusD2 = "closed";
        if (x === subMenuIndex){
            return;
        } else {
            dropLevel(x);
        }
    }
}

// update NPS scores data through JSON
    let npsScore;
    function loadNPSScore() {
        console.log('function called');
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            console.log(this.status);
            console.log("\nStatus Text: "+this.statusText);
            if (this.readyState == 4 && this.status == 200) {
                 npsScore = JSON.parse(this.responseText);
                document.getElementById('scoreDiv').innerHTML= npsScore.score;
                document.getElementById('promoter').innerHTML= npsScore.promoters;
                document.getElementById('neutral').innerHTML= npsScore.passive;
                document.getElementById('detractor').innerHTML= npsScore.detractors;
                let totalResp = Number(npsScore.promoters)+Number(npsScore.passive)+Number(npsScore.detractors);
                document.getElementById('resp').innerHTML = totalResp;
                 console.log('this is npsScore: '+npsScore);
            }
        };
        xhttp.open("POST", "/admin/php/nps.php", true);
        xhttp.send();
    }
// update Rsponses data through JSON


let responses;
function loadResponses() {
    console.log("loadResponses called \n");
    var xhttp = new XMLHttpRequest;
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
                console.log('Responses are: \n');
                responses = JSON.parse(this.responseText);
                console.log(responses[1]);
                respPageUpdate(responses);
            }
    };
    xhttp.open("POST", "/admin/php/responses.php", true);
    xhttp.send();
}


// load the json on html page
function respPageUpdate(responses){
    var respScrn = {
    responsesListed: {},
    selectedResponse: [],
    listContainer: document.querySelector('.respContainer'),
    listTemplate: document.querySelector('.listTemplate'),
    } 
    var listResp;
    for (i in responses) {
        console.log("list Constainer is: "+respScrn.listContainer);
        console.log('response is: \n' + responses[i].message);
        listResp = respScrn.listTemplate.cloneNode(true);
        listResp.classList.remove('listTemplate');
        listResp.setAttribute("id", i);
        listResp.setAttribute("onclick", "showResp("+i+")");
        listResp.querySelector('.ratingSelector').textContent = responses[i].rating;
        listResp.querySelector('.or_no').textContent = responses[i].or_no;
        listResp.querySelector('.consilierName').textContent = responses[i].Consilier;
        respScrn.listContainer.appendChild(listResp);
    }
}

function showResp(i) {
    document.querySelector('.message').textContent = responses[i].message;
}