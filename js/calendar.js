var d = new Date();
var dm = d.getMonth() + 1;
var dj = d.getYear();
if(dj < 999) dj+=1900;

function Kalender(Monat,Jahr) {
Monatsname = new Array
("Januar","Februar","M&auml;rz","April","Mai","Juni","Juli",
"August","September","Oktober","November","Dezember");
Tag = new Array ("Mo","Di","Mi","Do","Fr","Sa","So");

var jetzt = new Date();
var DieserMonat = jetzt.getMonth() + 1;

var DiesesJahr = jetzt.getYear();
if(DiesesJahr < 999) DiesesJahr+=1900;
var DieserTag = jetzt.getDate();
var Zeit = new Date(Jahr,Monat-1,1);
var Start = Zeit.getDay();
if(Start > 0) Start--;
else Start = 6;
var Stop = 31;
if(Monat==4 ||Monat==6 || Monat==9 || Monat==11 ) --Stop;
if(Monat==2) {
 Stop = Stop - 3;
 if(Jahr%4==0) Stop++;
 if(Jahr%100==0) Stop--;
 if(Jahr%400==0) Stop++;
}
document.write('<table class="align-center">');
var Monatskopf = Monatsname[Monat-1] + " " + Jahr;
SchreibeKopf(Monatskopf);
var Tageszahl = 1;
for(var i=0;i<=5;i++) {
  document.write("<tr>");
  for(var j=0;j<=5;j++) {
    if((i==0)&&(j < Start))
     SchreibeZelle("&#160;");
    else {
      if(Tageszahl > Stop)
        SchreibeZelle("&#160;");
      else {
        if((Jahr==DiesesJahr)&&(Monat==DieserMonat)&&(Tageszahl==DieserTag))
         SchreibeZelle(Tageszahl,true);
        else
         SchreibeZelle(Tageszahl);
        Tageszahl++;
        }
      }
    }
    if(Tageszahl > Stop)
      SchreibeZelle("&#160;");
    else {
      if((Jahr==DiesesJahr)&&(Monat==DieserMonat)&&(Tageszahl==DieserTag))
        SchreibeZelle(Tageszahl,true,true);
      else
        SchreibeZelle(Tageszahl,false,true);
      Tageszahl++;
    }
    document.write("<\/tr>");
  }
document.write("<\/table>");
}

function SchreibeKopf(Monatstitel) {
document.write("<tr>");
document.write('<td align="center" colspan="7" valign="middle"');
document.write('class="monat">');
document.write(Monatstitel);
document.write("<\/td><\/tr>");
document.write('<tr class="tage">');
for(var i=0;i<=6;i++)
  SchreibeZelle("&nbsp;"+Tag[i]+"&nbsp;");
document.write("<\/tr>");
}

function SchreibeZelle(Inhalt,heute,sonntag) {
document.write('<td align="center" valign="middle"');
if (heute)
	document.write('class="heute">');
else
	document.write('class="tag">');
if (sonntag)
  document.write('<span class="sonntag">');
document.write(Inhalt);
if (sonntag)
  document.write('</span>');

document.write("<\/td>");
}