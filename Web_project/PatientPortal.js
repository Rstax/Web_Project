
function remove(){
    var dash=document.getElementsByTagName("a");
    var divrem=document.getElementsByTagName("div");
    for(var i=1;i<6;i++)
    {
        dash[i].style.backgroundColor='white';
        dash[i].style.color='#818181';
    }
    for(var i=2;i<7;i++)
    {
        divrem[i].style.display='none';
    }
}
function D(){
    remove();
    var q1=document.getElementById("dashboard");
    q1.style.backgroundColor= 'rgb(206, 69, 216)';
    q1.style.color="rgb(255,255,255)";
    var divrem=document.getElementsByTagName("div");
    divrem[2].style.display='block';
}
function DL(){
    remove();
    var q1=document.getElementById("DL");
    q1.style.backgroundColor= 'rgb(206, 69, 216)';
    q1.style.color="rgb(255,255,255)";
    var divrem=document.getElementsByTagName("div");
    divrem[3].style.display='block';
}
function BMA(){
    remove();
    var q1=document.getElementById("BMA");
    q1.style.backgroundColor= 'rgb(206, 69, 216)';
    q1.style.color="rgb(255,255,255)";
    var divrem=document.getElementsByTagName("div");
    divrem[4].style.display='block';
}
function P(){
    remove();
    var q1=document.getElementById("P");
    q1.style.backgroundColor= 'rgb(206, 69, 216)';
    q1.style.color="rgb(255,255,255)";
    var divrem=document.getElementsByTagName("div");
    divrem[5].style.display='block';
}
function AH(){
    remove();
    var q1=document.getElementById("AH");
    q1.style.backgroundColor= 'rgb(206, 69, 216)';
    q1.style.color="rgb(255,255,255)";
    var divrem=document.getElementsByTagName("div");
    divrem[6].style.display='block';
}
