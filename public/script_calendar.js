var countStart = 0;
var daysChange = [];
var daysUnchange = [];
var cc = 4;
//Getting date
var dt = new Date(); // current date of week
var currentWeekDay = dt.getDay();
var lessDays = currentWeekDay === 0 ? 6 : currentWeekDay - 1;
var wkStart = new Date(new Date(dt).setDate(dt.getDate() - lessDays));
var wkEnd = new Date(new Date(wkStart).setDate(wkStart.getDate() + 4));

function debut(){
    changeFormat(wkStart, daysChange, daysUnchange);
    //Set days date
    setDaysDate(wkStart, dt, lessDays);

    initButtons();

    refresh(wkStart,wkEnd,countStart);

    document.getElementById("suivante").addEventListener("click",function(){
        countStart += 7
        wkStart = new Date(new Date(dt).setDate(dt.getDate() - lessDays+countStart));
        wkEnd = new Date(new Date(wkStart).setDate(wkStart.getDate() + 4));
        refresh(wkStart,wkEnd,countStart);
        setDaysDate(wkStart);
        changeFormat(wkStart, daysChange, daysUnchange);
        initButtons();
    });

//set date onclik previous
    document.getElementById("precedente").addEventListener("click",function(){
        countStart -= 7;
        wkEnd = new Date(new Date(wkStart).setDate(wkStart.getDate() + 4));
        wkStart = new Date(new Date(dt).setDate(dt.getDate() - lessDays+countStart));
        refresh(wkStart,wkEnd,countStart);
        setDaysDate(wkStart);
        changeFormat(wkStart, daysChange, daysUnchange);
        initButtons();
    });
}

function initButtons(){
    var medecin = url.substring(38);

    $.post
    (
        {
            url: url,
            data: "medecin=" + medecin,
        }).done(function (json) {
            datas = JSON.parse(json);
            document.getElementById("containBody").innerHTML = '';
            var element = document.getElementById("containBody");

            var hourTab = ['08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00'];

            var dateNow = new Date();
            var hourNow = new Date().toLocaleString('fr-FR', {
                hour: 'numeric',
                minute:'numeric',
            });

            for(i=0;i<hourTab.length;i++){
                const ligne = element.insertRow();
                for(j=0;j<5;j++){
                    var input = document.createElement("input");
                    input.type="button";
                    input.value= hourTab[i];
                    input.id = daysChange[j];
                    input.disabled = true;
                    input.className="inputs btn btn-success modalsearch";
                    input.onclick = function(){
                        document.getElementById("date").innerHTML = "Prendre un rendez-vous le " + this.id +"&nbsp";
                        document.getElementById("hour").innerHTML =  " à "+ this.value +"?";
                    }
                    input.setAttribute('data-toggle', 'modal');
                    input.setAttribute('data-target', '#exampleModal');

                    if(dateNow.getUTCDate() < daysUnchange[j].getUTCDate() && dateNow.getMonth() <= daysUnchange[j].getMonth() && dateNow.getFullYear() <= daysUnchange[j].getFullYear()) {
                        input.disabled = false;
                        ligne.insertCell().appendChild(input);
                    }
                    else if(dateNow.getMonth() < daysUnchange[j].getMonth() || dateNow.getFullYear() < daysUnchange[j].getFullYear()){
                        input.disabled = false;
                        ligne.insertCell().appendChild(input);
                    }
                    else if(dateNow.getUTCDate() === daysUnchange[j].getUTCDate() && dateNow.getMonth() === daysUnchange[j].getMonth() && dateNow.getFullYear() === daysUnchange[j].getFullYear() && hourNow < input.value){
                        input.disabled = false;
                        ligne.insertCell().appendChild(input);
                    }
                    else{
                        ligne.insertCell().appendChild(input);
                    }
                    for(k in datas){
                        var dateRDV = new Date(datas[k].DateRDV.date);
                        var heureRDV = new Date(datas[k].HeureRDV.date);

                        var heureChangeRDV = heureRDV.toLocaleString('fr-FR', {
                            hour: 'numeric',
                            minute:'numeric',
                        });
                        //SCRIPT POUR METTRE EN ROUGE LES BOUTONS ET EN DISABLED
                        if(dateRDV.getUTCDate() + 1 === daysUnchange[j].getUTCDate() && dateRDV.getUTCMonth() === daysUnchange[j].getUTCMonth() && dateRDV.getUTCFullYear() === daysUnchange[j].getUTCFullYear() && heureChangeRDV === input.value){
                            input.disabled = true;
                            input.className="inputs btn btn-danger modalsearch";
                        }
                    }
                }
            }
        }
    )
}
//refresh the date after the click
function refresh(wkStart, wkEnd, countStart){
    document.getElementById("precedente").disabled = countStart <= 0;
    wkStart = wkStart.toLocaleString('fr-FR', {
        month: 'long',
        day: 'numeric',
    });
    wkEnd = wkEnd.toLocaleString('fr-FR', {
        month: 'long',
        day: 'numeric',
        year: 'numeric',
    });
    document.getElementById("title").innerHTML = "Semaine du " + wkStart + " au " + wkEnd +".";
}

function setDaysDate(wkStart){
    document.getElementById("containHead").innerHTML = "";
    var monday = new Date(new Date(wkStart).setDate(wkStart.getDate()));
    monday = monday.toLocaleString('fr-FR', {
        weekday: 'long',
        day: 'numeric',
    });
    var tuesday = new Date(new Date(wkStart).setDate(wkStart.getDate() + 1));
    tuesday = tuesday.toLocaleString('fr-FR', {
        weekday: 'long',
        day: 'numeric',
    });
    var wednesday = new Date(new Date(wkStart).setDate(wkStart.getDate() + 2));
    wednesday = wednesday.toLocaleString('fr-FR', {
        weekday: 'long',
        day: 'numeric',
    });
    var thursday = new Date(new Date(wkStart).setDate(wkStart.getDate() + 3));
    thursday = thursday.toLocaleString('fr-FR', {
        weekday: 'long',
        day: 'numeric',
    });
    var friday = new Date(new Date(wkStart).setDate(wkStart.getDate() + 4));
    friday = friday.toLocaleString('fr-FR', {
        weekday: 'long',
        day: 'numeric',
    });
    var daysTab = [monday,tuesday,wednesday,thursday,friday];

    var element = document.getElementById("containHead");
    var ligne = element.insertRow();
    for(k=0;k<daysTab.length;k++){
        var titles = document.createElement("th");
        titles.innerHTML = daysTab[k];
        titles.className = "titleTable";
        ligne.appendChild(titles);
    }

}

function changeFormat(wkStart, daysChange, daysUnchange){
    daysUnchange.splice(0,5);
    var mondayChange = new Date(new Date(wkStart).setDate(wkStart.getDate()));
    daysUnchange.push(mondayChange);
    mondayChange = mondayChange.toLocaleString('fr-FR', {
        day: 'numeric',
        month:'numeric',
        year:'numeric',
    });
    var tuesdayChange = new Date(new Date(wkStart).setDate(wkStart.getDate() + 1));
    daysUnchange.push(tuesdayChange);
    tuesdayChange = tuesdayChange.toLocaleString('fr-FR', {
        day: 'numeric',
        month:'numeric',
        year:'numeric',
    });
    var wednesdayChange = new Date(new Date(wkStart).setDate(wkStart.getDate() + 2));
    daysUnchange.push(wednesdayChange);
    wednesdayChange = wednesdayChange.toLocaleString('fr-FR', {
        month:'numeric',
        day: 'numeric',
        year:'numeric',
    });
    var thursdayChange = new Date(new Date(wkStart).setDate(wkStart.getDate() + 3));
    daysUnchange.push(thursdayChange);
    thursdayChange = thursdayChange.toLocaleString('fr-FR', {
        month:'numeric',
        day: 'numeric',
        year:'numeric',
    });
    var fridayChange = new Date(new Date(wkStart).setDate(wkStart.getDate() + 4));

    daysUnchange.push(fridayChange);
    fridayChange = fridayChange.toLocaleString('fr-FR', {
        day: 'numeric',
        month:'numeric',
        year:'numeric',
    });

    daysChange.splice(0,5);
    daysChange.push(mondayChange,tuesdayChange,wednesdayChange,thursdayChange,fridayChange);

}

var url = document.location.href;

function datasRdv(){
    var date = document.getElementById("date").textContent;
    var dateRdv = date.substring(26,36);
    var hour = document.getElementById("hour").textContent;
    var hourRdv = hour.substring(3,8);

    $.post
    (
        {
            url: url,
            data: "dateRdv=" + dateRdv + "&&hourRdv=" + hourRdv,
        }).done(function () {
            document.location.reload();
        }
    )
}

window.onload = function() { debut(); };
