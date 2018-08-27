function ReloadImageSecurity()
{
	document.getElementById('ImageSecurity').src=document.getElementById('ImageSecurity').src+'1';
}

function ButtDone(value)
{
	document.getElementById('Done').disabled=value;
	
	return;
}

function ShowMsg(value)
{
	document.getElementById('ErrorMsgField').innerHTML=value;
	document.getElementById('ErrorMsgRegion').style.display='';
	
	return;
}